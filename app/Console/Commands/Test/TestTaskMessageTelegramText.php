<?php

namespace App\Console\Commands\Test;

use App\Models\TaskMessage;
use Illuminate\Console\Command;

class TestTaskMessageTelegramText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task-message-telegram-text';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $messages = TaskMessage::where('is_human', true)->where('text', '!=', '')->latest()->take(10)->get();
        foreach ($messages as $message) {
            $this->warn('Message # ' . $message->id);
            foreach (explode(PHP_EOL, $message->getTelegramText()) as $line) {
                $this->line($line);
            }
            $this->line('');
        }
        return Command::SUCCESS;
    }
}
