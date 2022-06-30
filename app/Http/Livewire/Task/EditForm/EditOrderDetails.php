<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditOrderDetails extends Component
{
    use WithFileUploads;
    public Task $task;
    public string $company_name;
    public string $it_is;
    public string $material;
    public string $total_cards;
    public string $instruction;
    public string $background;
    public string $design_comments;
    public string $card_details;
    public  $design_attachments = [];
    public  $card_details_attachments = [];
    public  $qr_attachments = [];


    protected $rules = [
        'company_name'    => 'required|max:255',
        'it_is'           => 'required|max:255',
        'material'        => 'required|max:255',
        'total_cards'     => 'required|max:255',
        'instruction'     => 'nullable|max:255',
        'background'      => 'nullable|max:255',
        'design_comments' => 'nullable',
        'design_attachments.*' => 'file|max:10000',
        'card_details_attachments.*' => 'file|max:10000',
        'qr_attachments.*' => 'file|max:10000',
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
        $this->design_attachments = $task->design_attachments;
        $this->card_details_attachments = $task->card_details_attachments;;
        $this->qr_attachments = $task->qr_attachments;;

    }
    public function editOrderDetails()
    {
        $this->validate();
        $this->updateTask();
        $this->updateTaskFiles();
        $this->emit('showModal', 'task.edit-task', $this->task->id);

    }
    public function updateTask()
    {
        $this->task->company_name = $this->company_name;
        $this->task->it_is = $this->it_is;
        $this->task->material = $this->material;
        $this->task->total_cards = $this->total_cards;
        $this->task->instruction = $this->instruction;
        $this->task->background = $this->background;
        $this->task->design_comments = $this->design_comments;
        $this->task->update();
    }
    public function updateTaskFiles()
    {
        foreach (TaskFile::MAIN_FIELDS as $field) {
            foreach ($this->{$field} as $file) {
                var_dump($file);
//                $this->task->files()->create([
//                    'type' => $field,
//                    'path' => $file->store('tasks/'  . $field ),
//                    'original_name' => $file->getClientOriginalName(),
//                    'size' => $file->getSize(),
//                ]);
            }
        }
        exit;
    }

    public function finishUpload($name, $tmpPath, $isMultiple)
    {
        Log::info('finish upload', $this->design_attachments);
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
    public function deleteFile(string $var_name, int $key)
    {
        if(isset($this->{$var_name}[$key]) && in_array($var_name, Task::FILES_FIELDS)) {
            unset($this->{$var_name}[$key]);
        }
    }
}
