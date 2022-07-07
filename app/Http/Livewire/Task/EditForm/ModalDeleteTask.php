<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class ModalDeleteTask extends Component
{
    public Task $task;
    public function mount(Task $task)
    {
        $this->task = $task;
    }
    public function render()
    {
        return view('livewire.task.edit-form.modal-delete-task');
    }
    public function closeModalDeleteTask()
    {
        $this->emit('showModal', 'task.edit-form.edit-main-info', $this->task->id);
    }
    public function confirmModalDeleteTask()
    {
        $stage_id = $this->task->stage_id;
        $this->task->deleteFull();

        $this->emit('refreshStage', $stage_id);
        $this->emit('hideModal');

    }
}
