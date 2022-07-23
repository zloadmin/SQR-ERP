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
    public string $company_name;
    public string $it_is;
    public string $material;
    public string $total_cards;
    public string $instruction;
    public string $background;
    public string $design_comments;
    public string $card_details;

    public $design_attachments = [];
    public $card_details_attachments = [];
    public $qr_attachments = [];

    public  $exist_design_attachments = [];
    public  $exist_card_details_attachments = [];
    public  $exist_qr_attachments = [];




    protected $rules = [
        'company_name'    => 'required|max:255',
        'it_is'           => 'required|max:255',
        'material'        => 'required|max:255',
        'total_cards'     => 'required|max:255',
        'instruction'     => 'nullable|max:255',
        'background'      => 'nullable|max:255',
        'design_comments' => 'nullable',
        'design_attachments.*' => 'file|max:200000',
        'card_details_attachments.*' => 'file|max:200000',
        'qr_attachments.*' => 'file|max:200000',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->company_name = $task->company_name;
        $this->it_is = $task->it_is;
        $this->material = $task->material;
        $this->total_cards = $task->total_cards;
        $this->instruction = $task->instruction;
        $this->background = $task->background;
        $this->design_comments = $task->design_comments;
        $this->card_details = $task->card_details;

        $this->exist_design_attachments = $task->getDesignAttachments();
        $this->exist_card_details_attachments = $task->getCardDetailsAttachments();;
        $this->exist_qr_attachments = $task->getQrAttachments();

    }
    public function editOrderDetails()
    {
        $this->validate();
        $task = $this->updateTask();
        $this->storeFiles($task);
        $this->deleteExistFiles();
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
//    public function updateTaskFiles()
//    {
//        foreach (TaskFile::MAIN_FIELDS as $field) {
//            foreach ($this->{$field} as $file) {
////                var_dump($file);
////                $this->task->files()->create([
////                    'type' => $field,
////                    'path' => $file->store('tasks/'  . $field ),
////                    'original_name' => $file->getClientOriginalName(),
////                    'size' => $file->getSize(),
////                ]);
//            }
//        }
////        exit;
//    }

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
        return view('livewire.task.edit-form.modal-edit-order-details');
    }

}
