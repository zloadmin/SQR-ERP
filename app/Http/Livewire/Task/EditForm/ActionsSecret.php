<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Stage;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Log as LaravelLog;

class ActionsSecret extends Component
{
    public string $uuid;
    public Task $task;
    public Stage $stage;
    public bool $editable;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->task = Task::firstByUUID($this->uuid);
        $this->editable = true;
        $this->stage = $this->task->stage;
    }

    public function getListeners()
    {
        return [
            'updateEditTaskActions' => 'updateTask'
        ];
    }

    public function updateTask()
    {
        \Illuminate\Support\Facades\Log::info('updateEditTaskActions listener');
        $this->mount($this->uuid, $this->editable);
    }

    public function render()
    {
        return view('livewire.task.edit-form.client-actions')
            ->layout('layouts.simple');
    }
}
