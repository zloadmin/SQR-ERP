<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use Livewire\Component;

class OrderDetails extends Component
{
    public Task $task;
    public bool $editable;
    public $latest_design_attachments_attachment;
    public $latest_qr_attachments_attachment;
    public $latest_card_details_attachment;

    public $latest_design_file_attachment;
    public $latest_content_file_attachment;
    public $latest_print_file_attachment;

    public function mount(Task $task, bool $editable)
    {
        $this->task = $task;
        $this->editable = $editable;
        $this->latest_design_attachments_attachment = $task->design_attachments()->latest()->first();
        $this->latest_qr_attachments_attachment = $task->qr_attachments()->latest()->first();
        $this->latest_card_details_attachment = $task->card_details_attachments()->latest()->first();

        $this->latest_design_file_attachment = $task->design_files()->latest()->first();
        $this->latest_content_file_attachment = $task->content_attachments()->latest()->first();
        $this->latest_print_file_attachment = $task->print_file_attachments()->latest()->first();


    }
    public function render()
    {
        return view('livewire.task.edit-form.order-details');
    }
}
