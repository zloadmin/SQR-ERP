<?php

namespace App\Console\Commands\Email;

use App\Http\Livewire\Task\EditForm\Log;
use App\Models\Email;
use App\Models\EmailAlert;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send not sent emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $emails = Email::where('sent', false)->where('recipient', '!=', '')->take(100)->get();
        foreach ($emails as $email) {
            try {
                $email->send();
            } catch (\Exception $exception) {
                \Illuminate\Support\Facades\Log::error($exception->getMessage(), $exception->getTrace());
            }
            $email->markAsSent();
        }
        return 0;
    }
}
