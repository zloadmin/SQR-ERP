<?php

namespace App\Http\Livewire\Task;


use App\Models\Stage;
use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreateTask extends ModalComponent
{
    use WithFileUploads;

    public Stage $stage;
    public string $company_name = '';
    public string $it_is = '';
    public string $material = '';
    public string $total_cards = '';
    public string $instruction = '';
    public string $background = '';
    public string $design_comments = '';
    public string $card_details = '';
    public string $contact_name = '';
    public string $contact_number = '';
    public string $whatsapp = '';
    public string $contact_email = '';
    public string $delivery_method = '';
    public string $emirate = '';
    public string $address = '';
    public $design_attachments = [];
    public $card_details_attachments = [];
    public $qr_attachments = [];


    protected $rules = [
        'company_name'    => 'required|max:255',
        'it_is'           => 'required|max:255',
        'material'        => 'required|max:255',
        'total_cards'     => 'required|max:255',
        'instruction'     => 'nullable|max:255',
        'background'      => 'nullable|max:255',
        'design_comments' => 'nullable',
        'card_details'    => 'nullable',
        'contact_name'    => 'nullable|max:255',
        'contact_number'  => 'nullable|max:255',
        'whatsapp'        => 'nullable|max:255',
        'contact_email'   => 'nullable|max:255',
        'delivery_method' => 'nullable|max:255',
        'emirate'         => 'nullable|max:255',
        'address'         => 'nullable',
        'design_attachments.*' => 'file|max:10000',
        'card_details_attachments.*' => 'file|max:10000',
        'qr_attachments.*' => 'file|max:10000',
    ];
    protected $validationAttributes = [
        'design_attachments.*' => 'design attachment',
        'card_details_attachments.*' => 'card details attachment',
        'qr_attachments.*' => 'qr attachment'
    ];


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
    public function getCollectionProperty()
    {
        return TemporaryUploadedFile::unserializeFromLivewireRequest(session()->get("report.{$this->collectionName}", 'livewire-files:'));
    }

    public function saveFilesToSession($collection)
    {
        session()->put("report.{$this->collectionName}", TemporaryUploadedFile::serializeMultipleForLivewireResponse($collection));
        return $collection;
    }


    public function mount(Stage $stage)
    {
        $this->stage = $stage;
    }


    public function createTask()
    {
        $this->validate();
        $this->storeTask();
        $this->emit('hideModal');
    }
    private function storeTask()
    {
        $task = new Task();
        $task->stage_id = $this->stage->id;
        $task->company_name = $this->company_name;
        $task->it_is = $this->it_is;
        $task->material = $this->material;
        $task->total_cards = $this->total_cards;
        $task->instruction = $this->instruction;
        $task->background = $this->background;
        $task->design_comments = $this->design_comments;
        $task->card_details = $this->card_details;
        $task->contact_name = $this->contact_name;
        $task->contact_number = $this->contact_number;
        $task->whatsapp = $this->whatsapp;
        $task->contact_email = $this->contact_email;
        $task->delivery_method = $this->delivery_method;
        $task->emirate = $this->emirate;
        $task->address = $this->address;
        $data = [];
        foreach (Task::FILES_FIELDS as $field) {
            $data[$field] = [];
            foreach ($this->{$field} as $file) {
                $data[$field][] = $file->store('tasks/'  . $field );
            }
            $task->{$field} = $data[$field];
        }
        $task->save();
    }
    public function render()
    {
        return view('livewire.task.modal-create-task-form')
            ->layout('layouts.simple');
    }
    public function deleteFile(string $var_name, int $key)
    {

        if(isset($this->{$var_name}[$key]) && in_array($var_name, Task::FILES_FIELDS)) {
            unset($this->{$var_name}[$key]);
        }
    }
}
