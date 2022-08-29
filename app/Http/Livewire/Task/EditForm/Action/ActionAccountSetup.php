<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use App\Models\TaskFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionAccountSetup extends Action
{
    use WithFileUploads;

    public ?TaskFile $attache;
    public ?TaskFile $last_attache;
    public string $username = '';
    public string $password = '';
    public ?int $next_stage = null;
    public Task $task;
    public bool $editable;


    protected function rules()
    {
        $rules = [
            'username'   => 'required|string|max:255',
            'password'   => 'required|string|max:255',
            'next_stage' => 'required|in:2,4'
        ];
        if(!$this->attache) {
            $rules['attache']    = 'required|file|max:204800';
        }
        return $rules;
    }

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->username = $task->sqr_card_username ?? '';
        $this->password = $task->sqr_card_password ?? '';
        $this->attache = $task->preload_qr_attachments()->latest()->first();
//        dd($this->attache);

    }

    public function submitQR()
    {
        $this->validate();
        if($this->attache) {
            $this->attache->changeType(TaskFile::QR_ATTACHMENTS);
        } else {
            $this->storeAttache();
        }
        $this->updateTask();
        $this->updateBlocks();
    }

    public function storeAttache()
    {
        $this->storeFile($this->attache, TaskFile::QR_ATTACHMENTS);
    }

    public function updateTask()
    {

        $this->task->sqr_card_username = $this->username;
        $this->task->sqr_card_password = $this->password;
        $this->task->stage_id = $this->next_stage;
        $this->task->update();
    }


    public function render()
    {
        return view('livewire.task.edit-form.action.action-account-setup');
    }
}
