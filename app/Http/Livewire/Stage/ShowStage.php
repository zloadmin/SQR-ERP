<?php

namespace App\Http\Livewire\Stage;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class ShowStage extends Component
{
    public Stage $stage;
    public Collection $tasks;

    function mount(Stage $stage)
    {
        $this->stage = $stage;
        $this->tasks = $this->getTasks();
    }
    private function getTasks(): Collection
    {
        return $this->stage->tasks()->with('tags')->orderBy('updated_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.stage.stage');
    }

    public function getListeners()
    {
        return [
            "echo:stages.{$this->stage->id},StageTasksUpdated" => 'updateTasks',
            'refreshStage' => 'refreshStageEvent'
        ];
    }

    public function refreshStageEvent(int $stage_id) {
        if($stage_id == $this->stage->id) {
            $this->updateTasks();
        }
    }
    public function updateTasks()
    {
        $this->tasks = $this->getTasks();
    }
}
