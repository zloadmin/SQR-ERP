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

    public function mount(Task $task)
    {
        $this->task = $task;
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
        $this->mount($this->task->refresh());
    }
}
