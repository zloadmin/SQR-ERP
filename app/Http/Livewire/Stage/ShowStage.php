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
    public string $stage_start_key;

    function mount(Stage $stage)
    {
        $this->stage = $stage;
        $this->stage_start_key = Stage::getStartKeyById($stage->id);
        $this->tasks = $this->getTasks();

    }

    private function getTasks(): Collection
    {
        $isSearch = false;
        $result = $this->stage->tasks()->with('tags');

        if ($this->search_text) {
            $isSearch = true;
            $result->where(function ($query) {
                $query->orWhere('company_name', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_name', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_number', 'LIKE', '%' . $this->search_text . '%');
                $query->orWhere('contact_email', 'LIKE', '%' . $this->search_text . '%');
            });
        }
        if ($this->stage->id == 9) {
            $result->orderByDesc($this->stage_start_key);
        } else {
            $result->orderBy($this->stage_start_key);
        }
        if (!$isSearch && $this->stage->id == 9) {
            $result->take(20);
        }

        $tasks = $result->get();
        if ($this->stage->id != 9) {
            $this->sortTaskCollection($tasks);
        }
        return $tasks;
    }

    public function sortTaskCollection(Collection &$tasks): void
    {
        $this->sortByTag($tasks, 'Priority');
        $this->sortByTag($tasks, 'Critical');

    }
//    public function sortByPriorityTag(Collection &$tasks) : void
//    {
//        $tasks = $tasks->sortByDesc(function (Task $task) {
//            return $task->tags()->where('name', 'Priority')->exists();
//        });
//    }
    public function sortByTag(Collection &$tasks, string $tag): void
    {
        $tasks = $tasks->sortByDesc(function (Task $task) use ($tag) {
            return $task->tags()->where('name', $tag)->exists();
        });
    }
//    public function sortByTags()
//    {
//
//    }
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
