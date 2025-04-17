<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Stage;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Log as LaravelLog;

class Actions extends Component
{
    public Task $task;
    public Stage $stage;
    public bool $editable;
    public function mount(Task $task, bool $editable = true)
    {
        $this->task = $task;
        $this->editable = $editable;
        $this->stage = $task->stage;
    }

//    public function render()
//    {
//        return view('livewire.task.edit-form.actions');
//    }

    public function getListeners()
    {
        return [
//            "echo:task.{$this->task->id},UpdateTaskStage" => 'updateTask',
            'updateEditTaskActions'                        => 'updateTask'
        ];
    }

    public function updateTask()
    {
//        \Illuminate\Support\Facades\Log::info('updateEditTaskActions listener');;
        $this->mount($this->task->refresh(), $this->editable);
    }
}
