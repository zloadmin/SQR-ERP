<?php

namespace App\Jobs;


use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateSQRCardOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Task $task)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->task->sqr_card_username && $this->task->sqr_card_password) {

            $print_file = $this->task->getLastPrintFileAttachment();

            $data = [
                'email'    => $this->task->sqr_card_username,
                'password' => $this->task->sqr_card_password,
                'order_id' => $this->task->id,
                'stage_id' => $this->task->stage_id,
                // details
                'date' => $this->task->created_at->toDateTimeString(),
                'total_cards' => $this->task->total_cards,
                'card_details' => $this->task->card_details,
                'contact_email' => $this->task->contact_email,
                'whatsapp' => $this->task->whatsapp,
                'print_file' => $print_file ? $print_file->getUrl() : ''
            ];

            $url = config('services.sqrcard.update_status_webhook');
            $response = Http::post($url, $data);
            if ($response->failed()) {
                Log::warning('UpdateSQRCardOrderStatus failed ' . $response->reason());
                Log::warning('UpdateSQRCardOrderStatus failed ' . $response->body());
            } else {
                Log::info('UpdateSQRCardOrderStatus success');
            }
        } else {
            Log::warning('UpdateSQRCardOrderStatus task without login and pass. ID: ' . $this->task->id);
        }
    }

}
