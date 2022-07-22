<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public string $search_text = "";

    public function render()
    {
        return view('livewire.search');
    }
    public function searchTasks()
    {
        $this->emit('searchTasksEvent', $this->search_text);
    }
}
