<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Stage;
use App\Models\Task;
use App\Models\TaskFile;
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
        $this->mount($this->task->refresh());
    }

    public function prevAction()
    {
        $this->task->update([
            'stage_id' => $this->task->getPrevStageId()
        ]);
        $this->mount($this->task->refresh());
    }

    public function storeFile($file, $type)
    {
        TaskFile::create([
            'task_id' => $this->task->id,
            'type'          => $type,
            'path'          => $file->store('tasks/' . $type),
            'original_name' => $file->getClientOriginalName(),
            'size'          => $file->getSize(),
            'user_id'       => auth()->check() ? auth()->id() : null,
        ]);
//        $this->task->files()->create([
//            'type'          => $type,
//            'path'          => $file->store('tasks/' . $type),
//            'original_name' => $file->getClientOriginalName(),
//            'size'          => $file->getSize(),
//            'user_id'       => auth()->check() ? auth()->id() : null,
//        ]);
    }

    public function storeAttacheFile($type)
    {
        $this->storeFile($this->attache, $type);
    }
    public function storeDesignAttacheFile()
    {
        $this->storeAttacheFile(TaskFile::DESIGN_ATTACHMENTS);
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
        $this->mount($this->task->refresh());
    }
    public function increaseTaskStageId()
    {
        $this->task->stage_id = $this->task->getNextStageId();
        $this->task->update();
        $this->mount($this->task->refresh());
    }

}
