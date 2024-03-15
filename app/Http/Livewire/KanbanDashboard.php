<?php

namespace App\Http\Livewire;

use App\Models\Stage;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class KanbanDashboard extends Component
{


    public function render()
    {
        return view('livewire.kanban-dashboard')
            ->layout('layouts.dashboard-kanban');
    }

}
