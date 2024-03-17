<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use App\Models\TaskFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionRMSupport extends Action
{
    use WithFileUploads;

    public $not_approve_qr_attache;
    public Task $task;
    public bool $editable;


    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->not_approve_qr_attache = $task->getLastNotApproveQRAttachment();
    }

    public function submitQR()
    {
        $this->updateTask();
        $this->updateBlocks();
    }

    public function updateTask(): void
    {
        $this->task->stage_id = 4; // Content
        $this->task->update();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-rm-support');
    }
}
