<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Http\Livewire\Traits\HasTaskFiles;
use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditOrderDetails extends Component
{
    use WithFileUploads, HasTaskFiles;
    public Task $task;
    public string $company_name = '';
    public string $it_is = '';
    public string $material = '';
    public string $total_cards = '';
    public string $instruction = '';
    public string $background = '';
    public string $design_comments = '';
    public string $card_details = '';

    protected $rules = [
        'company_name'    => 'required|max:255',
        'it_is'           => 'required|max:255',
        'material'        => 'required|max:255',
        'total_cards'     => 'required|max:255',
        'instruction'     => 'nullable|max:255',
        'background'      => 'nullable|max:255',
        'design_comments' => 'nullable',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->company_name = $task->company_name ?? '';
        $this->it_is = $task->it_is ?? '';
        $this->material = $task->material ?? '';
        $this->total_cards = $task->total_cards ?? '';
        $this->instruction = $task->instruction ?? '';
        $this->background = $task->background ?? '';
        $this->design_comments = $task->design_comments ?? '';
        $this->card_details = $task->card_details ?? '';
    }
    public function editOrderDetails()
    {
        $this->validate();
        $this->updateTask();
        $this->emit('showModal', 'task.edit-task', $this->task->id);
    }
    public function updateTask() : Task
    {
        $this->task->company_name = $this->company_name;
        $this->task->it_is = $this->it_is;
        $this->task->material = $this->material;
        $this->task->total_cards = $this->total_cards;
        $this->task->instruction = $this->instruction;
        $this->task->background = $this->background;
        $this->task->design_comments = $this->design_comments;
        $this->task->card_details = $this->card_details;
        $this->task->update();
        return $this->task;
    }


    public function render()
    {
        return view('livewire.task.edit-form.modal-edit-order-details');
    }

}
