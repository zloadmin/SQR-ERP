<?php

namespace App\Jobs;

use App\Models\Inventory;
use Illuminate\Support\Facades\Log;
use App\Models\Task;
use App\Models\TelegramAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTelegramInventoryAlerts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Inventory $inventory;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $telegramAlerts = TelegramAlert::where('inventory_id', $this->inventory->id)->where('available_less_then', '>=', '0')->get();
        foreach ($telegramAlerts as $telegramAlert) {
            if($this->inventory->available < $telegramAlert->available_less_then) {
                foreach ($telegramAlert->recipient_ids as $recipient_id) {
                    Log::info('SendTelegramInventoryAlerts', ['recipient_id' => $recipient_id, 'telegramAlert ID' => $telegramAlert->id]);
                    SendTelegramInventoryAlert::dispatch($telegramAlert, $recipient_id, $this->inventory);
                }
            }
        }
    }
}
