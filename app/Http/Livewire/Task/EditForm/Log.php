<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Component;

class Log extends Component
{
    public Task $task;
    public Collection $messages;
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->messages = $task->messages()->latest()->get();
    }
    public function render()
    {
        return view('livewire.task.edit-form.log');
    }
}
