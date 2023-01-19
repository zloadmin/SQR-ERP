<?php

namespace App\Listeners;

use App\Clients\TelegramApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTaskMessageToTelegram implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {

        foreach ($event->taskMessage->getTelegramRecipients() as $recipient) {
            $response = TelegramApi::sendMessage($recipient, $event->taskMessage->getTelegramText());
            Log::info('SendTaskMessageToTelegram', (array)$response);
        }

    }
}
