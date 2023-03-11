<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionPrintFile extends Action
{

    use WithFileUploads;

    public $attache;
    public Task $task;
    public bool $editable;
    public $qr_arrache;
    public $design_attache;
    public $content_attache;
    public $print_file_attache;


    protected $rules = [
        'attache'  => 'required|file|max:204800'
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->qr_arrache = $task->getLastQRAttachment();
        $this->content_attache = $task->getLastContentAttachment();
        $this->print_file_attache = $task->getLastPrintFileAttachment();
    }
    public function submitAttache()
    {
        if($this->isRequiredMaterial()) {
            return $this->setRequiredMaterialError();
        }

        $this->validate();
        $this->storePrintFileAttacheFile();
        $this->increaseTaskStageId();
        $this->updateBlocks();
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-print-file');
    }
}
