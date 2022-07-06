<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditTask extends Component
{
    public Task $task;
    protected $listeners = ['updateEditTaskActions' => 'updateTask'];

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
    public function closeTaskModal()
    {
//        Log::info('closeTaskModal');
        $this->emit('refreshStage', $this->task->stage_id);
        $this->emit('hideModal');
    }
    public function updateTask()
    {
        $this->mount($this->task->refresh());
    }
}
