<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;

class ActionDesignApproval extends Action
{
    public Task $task;
    public bool $editable;
//    public $qr_arrache;
    public $design_attache;
    public $comment;
    protected $rules = [
        'comment'  => 'required'
    ];
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
//        $this->qr_arrache = $task->getLastQRAttachment();
        $this->design_file = $task->getLastDesignFile();
        $this->comment = '';
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-design-approval');
    }
    public function approve()
    {
        $this->design_file->approve($this->comment);
        $this->increaseTaskStageId();
        $this->updateBlocks();
    }
    public function decline()
    {
        $this->validate();
        $this->design_file->decline($this->comment);
        $this->decreaseTaskStageId();
        $this->updateBlocks();
    }


}
