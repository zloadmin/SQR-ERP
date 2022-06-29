<?php

namespace App\Http\Livewire\Stage;

use App\Models\Stage;
use Illuminate\Support\Collection;
use Livewire\Component;


class StageList extends Component
{
    public Collection $stages;

    public function mount()
    {
        $this->stages = Stage::with('tasks')->get();
    }

    public function render()
    {
        return view('livewire.stage.stage-list');
    }
}
