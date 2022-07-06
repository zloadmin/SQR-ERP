<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use App\Models\TaskFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionDesign extends Action
{
    use WithFileUploads;

    public $attache;
    public Task $task;
    public bool $editable;
    public $qr_arrache;
    public $not_approve_design_attache;


    protected $rules = [
        'attache'  => 'required|file'
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->qr_arrache = $task->getLastQRAttachment();
        $this->not_approve_design_attache = $task->getLastNotApproveDesignAttachment();
    }
    public function submitAttache()
    {
        $this->validate();
        $this->storeDesignAttacheFile();
        $this->increaseTaskStageId();
        $this->updateBlocks();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-design');
    }
}
