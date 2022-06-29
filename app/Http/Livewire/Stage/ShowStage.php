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
        return [ "echo:stages.{$this->stage->id},StageTasksUpdated" => 'updateTasks', ];
    }

    public function updateTasks()
    {
        $this->tasks = $this->stage->tasks()->orderBy('updated_at')->get();
    }

}
