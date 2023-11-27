<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Log extends Component
{
    public Task $task;
    public bool $editable;
    public Collection $log_messages;
    public array $telegram_usernames;
    public string $text = '';
    protected $rules = [
        'text'    => 'nullable|min:10',
    ];


    public function mount(Task $task, bool $editable)
    {
        $this->task = $task;
        $this->editable = $editable;
        $this->telegram_usernames = $this->getTelegramUsernames();
        $this->setLogMessages();
    }
    public function getTelegramUsernames() : array
    {
        return User::whereNotNull('telegram_username')->pluck('telegram_username', 'telegram_username')->toArray();
    }
    public function getListeners()
    {
        return [
            "echo:message_task.{$this->task->id},CreateTaskMessage" => 'setLogMessages',
            "updateEditTaskLog" => 'setLogMessages',
        ];
    }
    public function setLogMessages()
    {
//        \Illuminate\Support\Facades\Log::info('updateEditTaskLog listener');
        $this->log_messages = $this->task->messages()->with(['user', 'user.role'])->latest()->get();
    }
    public function createMessage()
    {
        $this->validate();
        $this->createLogMessage();
        $this->cleanLogMessageForm();
        $this->setLogMessages();
    }
    public function createLogMessage() {
        $this->task->messages()->create([
            'user_id' => auth()->id(),
            'text' => $this->text,
            'is_human' => true
        ]);
    }
    public function cleanLogMessageForm()
    {
        $this->text = '';
    }
    public function render()
    {
        return view('livewire.task.edit-form.log');
    }


}
