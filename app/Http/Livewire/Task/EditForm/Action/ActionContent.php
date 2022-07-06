<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionContent extends Action
{
    use WithFileUploads;

    public $attache;
    public Task $task;
    public bool $editable;
    public $qr_arrache;
    public $design_file;
    public $not_approve_content_attache;


    protected $rules = [
        'attache'  => 'required|file'
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->qr_arrache = $task->getLastQRAttachment();
        $this->design_file = $task->getLastDesignFile();
        $this->not_approve_content_attache = $task->getLastNotApproveContentAttachment();
    }
    public function submitAttache()
    {
        $this->validate();
        $this->storeContentAttacheFile();
        $this->increaseTaskStageId();
        $this->updateBlocks();
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-content');
    }
}
