<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class Actions extends Component
{
    public Task $task;
    public function render()
    {
        return view('livewire.task.edit-form.actions');
    }
}
