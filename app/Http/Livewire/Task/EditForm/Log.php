<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Component;

class Log extends Component
{
    public Task $task;
    public Collection $log_messages;
    public string $text = '';
    protected $rules = [
        'text'    => 'nullable|min:10',
    ];
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->setLogMessages();
    }
    public function setLogMessages()
    {
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
