<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class Sla extends Component
{
    public Task $task;
    public \App\Models\SLA $sla;
    public array $info;
    public string $time_left;
    public string $total_time;
    public string $start_stage;
    public bool $late;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->sla = $task->sla;
        $this->time_left = $task->getCurrentSLATimeLeft();
//        $this->total_time = $this->sla->getTotalTimeText();
        $this->revisions = $this->task->getRevisions();
        $this->start_stage = $this->task->getStageStart()->toDateTimeString();
        $this->late = $this->getLate();
//        dd($this->total_time);
//        dd($this->time_left);
    }

    public function getLate() : bool
    {
        $finish = $this->task->getStageStart()->addSeconds($this->sla->time);
        return $finish->timestamp <= now()->timestamp;
    }

    public function getTimeLeft(): string
    {
        return $this->task->getStageStart()->longAbsoluteDiffForHumans(now());
    }

    public function getListeners()
    {
        return [
//            "echo:task.{$this->task->id},UpdateTaskStage" => 'updateTask',
            "updateEditTaskSLA" => 'updateTask',
        ];
    }

    public function updateTask()
    {
        \Illuminate\Support\Facades\Log::info('updateEditTaskSLA listener');
        $this->mount($this->task->refresh());
    }

    public function render()
    {
        return view('livewire.task.edit-form.sla');
    }



}
