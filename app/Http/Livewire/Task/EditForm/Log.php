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
    public string $text = '';
    protected $rules = [
        'text'    => 'nullable|min:10',
    ];

    public $name;
    public $userId;
    public $users;
    public $user;

    public function updatedUserId()
    {
        $this->user = User::find($this->userId);
    }

    public function updatedName()
    {
        $this->getUsers();
    }

    public function getUsers()
    {
        $this->users = User::query()
            ->when($this->name, function ($query, $name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('name')
            ->get();
    }

    public function mount(Task $task, bool $editable)
    {
        $this->task = $task;
        $this->editable = $editable;
        $this->setLogMessages();
        $this->getUsers();
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
