<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;

class Action extends Component
{
    public Task $task;
    public function mount(Task $task)
    {
        $this->task = $task;
    }
//    public function render()
//    {
//        return view('livewire.task.edit-form.action.action');
//    }
}
