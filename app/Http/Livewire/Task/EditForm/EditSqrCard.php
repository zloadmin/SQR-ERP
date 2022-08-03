<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class EditSqrCard extends Component
{
    public Task $task;
    public string $sqr_card_username = '';
    public string $sqr_card_password = '';
    protected $rules = [
        'sqr_card_username' => 'nullable|max:255',
        'sqr_card_password' => 'nullable|max:255',
    ];


    public function mount(Task $task)
    {
        $this->task = $task;
        $this->sqr_card_username = $task->sqr_card_username ?? '';
        $this->sqr_card_password = $task->sqr_card_password ?? '';
    }


    public function editSQRCard()
    {
        $this->validate();
        $this->updateTask();
        $this->emit('showModal', 'task.edit-task', $this->task->id);
    }

    public function updateTask(): void
    {
        $this->task->sqr_card_username = $this->sqr_card_username;
        $this->task->sqr_card_password = $this->sqr_card_password;
        $this->task->update();
    }

    public function render()
    {
        return view('livewire.task.edit-form.modal-edit-sqr-card');
    }


}
