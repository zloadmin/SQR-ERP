<?php

namespace App\Http\Livewire\Stage;

use App\Models\Stage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class ShowStage extends Component
{
    public Stage $stage;
    public Collection $tasks;


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
        $this->tasks = $this->stage->tasks()->orderBy('updated_at')->get();
    }


}
