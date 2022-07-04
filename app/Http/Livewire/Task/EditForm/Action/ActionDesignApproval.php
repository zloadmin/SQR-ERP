<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;

class ActionDesignApproval extends Action
{
    public Task $task;
    public $qr_arrache;
    public $design_attache;
    public $comment;
    protected $rules = [
        'comment'  => 'required'
    ];
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->qr_arrache = $task->getLastQRAttachment();
        $this->design_attache = $task->getLastDesignAttachment();
        $this->comment = '';
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-design-approval');
    }
    public function approve()
    {
        $this->updateDesignApproveAttach();
        $this->increaseTaskStageId();
    }
    public function decline()
    {
        $this->validate();
        $this->updateDesignDeclineAttach();
        $this->decreaseTaskStageId();
    }
    public function updateDesignDeclineAttach()
    {
        $this->design_attache->approved = false;
        $this->design_attache->approved_comment = $this->comment;
        $this->design_attache->approved_user_id = auth()->check() ? auth()->id() : null;
        $this->design_attache->update();
    }
    public function updateDesignApproveAttach()
    {
        $this->design_attache->approved = true;
        $this->design_attache->approved_comment = $this->comment;
        $this->design_attache->approved_user_id = auth()->check() ? auth()->id() : null;
        $this->design_attache->update();
    }

}
