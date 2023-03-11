<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;

class ActionContentApproval extends Action
{
    public Task $task;
    public bool $editable;
//    public $qr_arrache;
//    public $design_attache;
    public $content_attache;
    public $comment;
    protected $rules = [
        'comment'  => 'required'
    ];
    public function mount(Task $task, bool $guest = false)
    {
        $this->task = $task;
        $this->editable = $guest || $this->getEditable($task);
//        $this->qr_arrache = $task->getLastQRAttachment();
//        $this->design_attache = $task->getLastDesignAttachment();
        $this->content_attache = $task->getLastContentAttachment();
        $this->comment = '';
    }

    public function approve()
    {
        if($this->isRequiredMaterial()) {
            return $this->setRequiredMaterialError();
        }

        $this->content_attache->approve($this->comment);
        $this->increaseTaskStageId();
        $this->updateBlocks();
    }
    public function decline()
    {
        if($this->isRequiredMaterial()) {
            return $this->setRequiredMaterialError();
        }

        $this->validate();
        $this->content_attache->decline($this->comment);
        $this->decreaseTaskStageId();
        $this->updateBlocks();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-content-approval');
    }
}
