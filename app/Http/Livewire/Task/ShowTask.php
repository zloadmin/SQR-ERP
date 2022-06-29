<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class ShowTask extends Component
{
    public Task $task;



    public function render()
    {
        return view('livewire.task.task');
    }


}
