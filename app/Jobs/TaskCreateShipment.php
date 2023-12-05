<?php

namespace App\Jobs;

use App\Clients\Aramex;
use Illuminate\Bus\Queueable;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskCreateShipment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $aramex = (new Aramex($this->task))->sendCreateShipmentsRequest();
        $aramex_response = json_decode($aramex->body(), true);
        $this->task->update(['aramex_submitted' => true]);
        $this->task->aramexRequests()->create([
            'aramex_body' => $aramex->body(),
            'aramex_response' => $aramex_response
        ]);
        $errors = $this->getErrorsText($aramex_response);
        if ($errors) {
            $this->task->messages()->create([
                'text' => 'Aramex: Errors ' . $errors
            ]);
        }
        $labelURL = $this->getLabelURL($aramex_response);
        if ($labelURL) {
            $this->task->messages()->create([
                'text' => 'Aramex: Label URL - ' . $labelURL
            ]);
        }

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
