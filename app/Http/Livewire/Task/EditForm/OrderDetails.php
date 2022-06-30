<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class OrderDetails extends Component
{
    public Task $task;
    public function render()
    {
        return view('livewire.task.edit-form.order-details');
    }
}
