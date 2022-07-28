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
    public string $search_text = "";

    function mount(Stage $stage)
    {
        $this->stage = $stage;
        $this->tasks = $this->getTasks();
    }

    private function getTasks(): Collection
    {
        $result = $this->stage->tasks()->with('tags')->latest();

        if ($this->search_text) {
            $result->where(function ($query) {
                $query->orWhere('company_name', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_name', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_number', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_email', 'LIKE', '%' . $this->search_text . '%');
            });
        }
        return $result->get();
    }

    public function render()
    {
        return view('livewire.stage.stage');
    }

    public function getListeners()
    {
        return [
            "echo:stages.{$this->stage->id},StageTasksUpdated" => 'updateTasks',
            'refreshStage'                                     => 'refreshStageEvent',
            'searchTasksEvent'                                 => 'searchTasksListener'
        ];
    }

    public function refreshStageEvent(int $stage_id)
    {
        if ($stage_id == $this->stage->id) {
            $this->updateTasks();
        }
    }

    public function updateTasks()
    {
        Log::info('updateTasks');
        $this->tasks = $this->getTasks();
    }

    public function searchTasksListener(string $search_text)
    {
        $this->search_text = $search_text;
        $this->updateTasks();
    }
}
