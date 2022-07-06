<?php

namespace App\Http\Livewire\Stage;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;


class StageList extends Component
{
    public Collection $stages;

    public function mount()
    {
        $stage_keys = auth()->user()->getAccessStagesShowKeys();

        $this->stages = Stage::whereIn('key', $stage_keys)->get();



//        $this->stages = Stage::with(['tasks' => function ($query) {
//            $query->orderBy('updated_at', 'desc');
//        }])->get();
    }

    public function render()
    {
        return view('livewire.stage.stage-list');
    }
}
