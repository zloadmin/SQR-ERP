<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;

class ActionProduction extends Action
{
    public Task $task;
    public bool $editable;
    public $qr_arrache;
    public $design_attache;
    public $content_attache;
    public $print_file_attache;


    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->qr_arrache = $task->getLastQRAttachment();
        $this->design_file = $task->getLastDesignFile();
        $this->content_attache = $task->getLastContentAttachment();
        $this->print_file_attache = $task->getLastPrintFileAttachment();
    }

    public function nextActionProduction()
    {
        $this->nextAction();
        $this->updateBlocks();
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-production');
    }
}
