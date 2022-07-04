<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Stage;
use App\Models\Task;
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
    public function render()
    {
        return view('livewire.task.edit-form.action.action');
    }

}
