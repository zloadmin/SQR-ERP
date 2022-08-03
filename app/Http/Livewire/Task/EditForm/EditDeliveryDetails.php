<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class EditDeliveryDetails extends Component
{
    public Task $task;
    public string $contact_name = '';
    public string $contact_number = '';
    public string $whatsapp = '';
    public string $contact_email = '';
    public string $delivery_method = '';
    public string $emirate = '';
    public string $address = '';

    protected $rules = [
        'contact_name'    => 'nullable|max:255',
        'contact_number'  => 'nullable|max:255',
        'whatsapp'        => 'nullable|max:255',
        'contact_email'   => 'nullable|max:255',
        'delivery_method' => 'nullable|max:255',
        'emirate'         => 'nullable|max:255',
        'address'         => 'nullable',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->contact_name = $task->contact_name ?? '';
        $this->contact_number = $task->contact_number ?? '';
        $this->whatsapp = $task->whatsapp ?? '';
        $this->contact_email = $task->contact_email ?? '';
        $this->delivery_method = $task->delivery_method ?? '';
        $this->emirate = $task->emirate ?? '';
        $this->address = $task->address ?? '';

    }
    public function render()
    {
        return view('livewire.task.edit-form.modal-edit-delivery-details');
    }
    public function editDeliveryDetails()
    {
        $this->validate();
        $this->updateTask();
        $this->emit('showModal', 'task.edit-task', $this->task->id);
    }
    public function updateTask() : void
    {
        $this->task->contact_name = $this->contact_name;
        $this->task->contact_number = $this->contact_number;
        $this->task->whatsapp = $this->whatsapp;
        $this->task->contact_email = $this->contact_email;
        $this->task->delivery_method = $this->delivery_method;
        $this->task->emirate = $this->emirate;
        $this->task->address = $this->address;
        $this->task->update();
    }
}
