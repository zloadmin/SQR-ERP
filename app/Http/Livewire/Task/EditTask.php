<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class EditTask extends Component
{
    public Task $task;
    public function mount(Task $task)
    {
        $this->task = $task;
    }
    public function render()
    {
        return view('livewire.task.modal-edit-task')
//        return view('livewire.task.edit-task-form')
            ->layout('layouts.simple');
    }
}
