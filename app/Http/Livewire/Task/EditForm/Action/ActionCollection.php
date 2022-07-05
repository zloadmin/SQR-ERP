<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use App\Models\TaskFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionCollection extends Action
{
    use WithFileUploads;

    public $attache;
    public string $card_collected;
    public string $delivery_reference;
    public Task $task;


    protected $rules = [
        'card_collected' => 'required|string|max:255',
        'delivery_reference' => 'required|string|max:255',
        'attache'  => 'required|file'
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->card_collected = $task->card_collected;
        $this->delivery_reference = $task->delivery_reference;
    }

    public function submitDeliverySlip()
    {
        $this->validate();
        $this->storeAttache();
        $this->updateTask();

    }

    public function storeAttache()
    {
        $this->storeFile($this->attache, TaskFile::DELIVERY_SLIP_ATTACHMENTS);
    }

    public function updateTask()
    {
        $this->task->card_collected = $this->card_collected;
        $this->task->delivery_reference = $this->delivery_reference;
        $this->task->stage_id = $this->task->getNextStageId();
        $this->task->update();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-collection');
    }
}
