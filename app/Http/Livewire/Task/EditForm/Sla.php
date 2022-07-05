<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class Sla extends Component
{
    public Task $task;
    public function getListeners()
    {
        return [
            "echo:task.{$this->task->id},UpdateTaskStage" => 'updateTask',
        ];
    }
    public function updateTask(array $data)
    {
        $this->mount($this->task->refresh());
    }
    public function render()
    {
        return view('livewire.task.edit-form.sla');
    }

}
