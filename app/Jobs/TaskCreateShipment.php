<?php

namespace App\Jobs;

use App\Clients\Aramex;
use App\Models\TaskFile;
use App\Models\TaskMessage;
use Illuminate\Bus\Queueable;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class TaskCreateShipment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 60 * 5 + 120;

    private Task $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $aramex = (new Aramex($this->task));
        $filePath = '';
        $createShipmentResponse = $aramex->sendCreateShipmentsRequest();
        $aramexResponse = [];
        $createShipmentResponseArray = json_decode((string)$createShipmentResponse->body(), true) ?? [];
        $aramexResponse['createShipment'] = $createShipmentResponseArray;

        if ($aramex->isInternational() && isset($createShipmentResponseArray['Shipments'][0]['ID'])) {
            sleep(60 * 5);
            $taskFile = $this->task->createAramexDocumentTaskFile();
            $filePath = $taskFile->real_path;
            $addShipmentAttachmentResponse = $aramex->sendAddShipmentAttachmentRequest($createShipmentResponseArray['Shipments'][0]['ID'], $taskFile->real_path);
            $addShipmentAttachmentResponseArray = json_decode((string)$addShipmentAttachmentResponse->body(), true) ?? [];
            $aramexResponse['addShipmentAttachment'] = $addShipmentAttachmentResponseArray;
            TaskMessage::addCreateFile($taskFile);
        }

        $this->task->updateQuietly(['aramex_submitted' => true]);
        $this->task->aramexRequests()->create([
            'aramex_body'     => $createShipmentResponse->body(),
            'aramex_response' => $aramexResponse,
            'file_path'       => $filePath
        ]);
        $errors = $this->getErrorsText($createShipmentResponseArray);
        if ($errors) {
            $this->task->messages()->create([
                'text' => 'Aramex: Errors ' . $errors
            ]);
        }
        $labelURL = $this->getLabelURL($createShipmentResponseArray);
        if ($labelURL) {
            $file = $this->createFromUrl($labelURL, pathinfo($labelURL, PATHINFO_BASENAME));
            TaskFile::storeUploadFile($this->task, TaskFile::DELIVERY_SLIP_ATTACHMENTS, $file, true);
            $this->task->messages()->create([
                'text' => 'Aramex: Label URL - ' . $labelURL
            ]);
        }

    }

    public function createFromUrl(string $url, string $originalName = '', string $mimeType = null, int $error = null, bool $test = false): UploadedFile
    {
        if (!$stream = @fopen($url, 'r')) {
            throw new \Exception('Cannot open url ' . $url);
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'url-file-');

        file_put_contents($tempFile, $stream);

        return new UploadedFile($tempFile, $originalName, $mimeType, $error, $test);
    }

    private function getErrorsText($aramex): string
    {
        $errors = [];
        if (isset($aramex['HasErrors']) && $aramex['HasErrors']) {
            if (isset($aramex['Shipments'][0]['Notifications']) && is_array($aramex['Shipments'][0]['Notifications'])) {
                foreach ($aramex['Shipments'][0]['Notifications'] as $data) {
                    if (isset($data['Message'])) {
                        $errors[] = $data['Message'];
                    }
                }
            }
        }
        return implode(PHP_EOL, $errors);
    }

    private function getLabelURL($aramex_response): string
    {

        return $aramex_response['Shipments'][0]['ShipmentLabel']['LabelURL'] ?? '';
    }


}
