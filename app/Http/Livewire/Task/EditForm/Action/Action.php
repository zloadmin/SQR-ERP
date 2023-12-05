<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Http\Livewire\Task\EditForm\Log;
use App\Models\Stage;
use App\Models\Task;
use App\Models\TaskFile;
use App\Models\UserRole;
use Livewire\Component;

class Action extends Component
{
    public Task $task;


    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function nextAction()
    {
        $this->task->update([
            'stage_id' => $this->task->getNextStageId()
        ]);
        $this->mount($this->task->refresh(), $this->editable);
    }

    public function prevAction()
    {
        $this->task->update([
            'stage_id' => $this->task->getPrevStageId()
        ]);
        $this->mount($this->task->refresh(), $this->editable);
    }

    public function storeFile($file, $type)
    {
        TaskFile::create([
            'task_id' => $this->task->id,
            'type' => $type,
            'path' => $file->store('tasks/' . $type),
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'user_id' => auth()->check() ? auth()->id() : null
        ]);

    }

    public function storeAttacheFile($type)
    {
        $this->storeFile($this->attache, $type);
    }

    public function storeDesignFile()
    {
        $this->storeAttacheFile(TaskFile::DESIGN_FILE);
    }

    public function storeContentAttacheFile()
    {
        $this->storeAttacheFile(TaskFile::CONTENT_ATTACHMENTS);
    }

    public function storePrintFileAttacheFile()
    {
        $this->storeAttacheFile(TaskFile::PRINTING_FILE_ATTACHMENTS);
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action');
    }

    public function decreaseTaskStageId()
    {
        $this->task->stage_id = $this->task->getPrevStageId();
        $this->task->update();
        $this->mount($this->task->refresh(), $this->editable);
    }

    public function increaseTaskStageId()
    {
        $this->task->stage_id = $this->task->getNextStageId();
        $this->task->update();
        $this->mount($this->task->refresh(), $this->editable);
    }

    public function updateBlocks()
    {
        $this->emit('updateEditCardSQRCardBlock');
        $this->emit('updateEditTaskActions');
        $this->emit('updateEditTaskSLA');
        $this->emit('updateEditTaskLog');
        $this->emit('refreshStage', $this->task->stage_id);
    }

    public function getEditable(Task $task): bool
    {
        return auth()->user()->canEditActions($task);
    }

    public function isRequiredMaterial(): bool
    {
        return !$this->task->material;
    }

    public function setRequiredMaterialError()
    {
        session()->flash('error', Task::MATERIAL_REQUIRED_ERROR);
    }
}
