<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Http\Livewire\Traits\HasTaskFiles;
use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditOrderAttachments extends Component
{
    use WithFileUploads, HasTaskFiles;

    public Task $task;


    public $design_attachments = [];
    public $card_details_attachments = [];
    public $qr_attachments = [];

    public $exist_design_attachments = [];
    public $exist_card_details_attachments = [];
    public $exist_qr_attachments = [];


    protected $rules = [
        'design_attachments.*'       => 'file|max:4194304',
        'card_details_attachments.*' => 'file|max:4194304',
        'qr_attachments.*'           => 'file|max:4194304',
    ];

    public function mount(Task $task)
    {
        $this->exist_design_attachments = $task->getDesignAttachments();
        $this->exist_card_details_attachments = $task->getCardDetailsAttachments();;
        $this->exist_qr_attachments = $task->getQrAttachments();
        $this->task = $task;
    }

    public function editOrderDetails()
    {
        $this->validate();
        $this->storeFiles($this->task);
        $this->deleteExistFiles();
        $this->emit('showModal', 'task.edit-task', $this->task->id);
    }


    public function finishUpload($name, $tmpPath, $isMultiple)
    {
        $this->cleanupOldUploads();

        $files = collect($tmpPath)->map(function ($i) {
            return TemporaryUploadedFile::createFromLivewire($i);
        })->toArray();
        $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());

        $files = array_merge($this->getPropertyValue($name), $files);
        $this->syncInput($name, $files);
    }

    public function render()
    {
        return view('livewire.task.edit-form.modal-edit-order-attachments');
    }

}
