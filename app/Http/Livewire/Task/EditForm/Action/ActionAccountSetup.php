<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use App\Models\TaskFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionAccountSetup extends Action
{
    use WithFileUploads;

    public $attache;
    public ?TaskFile $preload_attache = null;
    public ?TaskFile $last_attache;
    public $not_approve_qr_attache;
    public string $username = '';
    public string $password = '';
    public ?int $next_stage = null;
    public Task $task;
    public bool $editable;

    protected $rules = [
        'username'   => 'required|string|max:255',
        'password'   => 'required|string|max:255',
        'next_stage' => 'required|in:2,4',
        'attache'    => 'required|file|max:4194304',
    ];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->username = $task->sqr_card_username ?? '';
        $this->password = $task->sqr_card_password ?? '';
        $this->preload_attache = $task->preload_qr_attachments()->latest()->first();
        $this->not_approve_qr_attache = $task->getLastNotApproveQRAttachment();
        if ($this->preload_attache) {
            $this->attache = $this->preload_attache;
        }
    }

    public function submitQR()
    {

        if ($this->isRequiredMaterial()) {
            return $this->setRequiredMaterialError();
        }
        if ($this->isUploadedAttachment()) {
            $this->validate($this->rulesWithAttacheFile());
            $this->storeAttache();
            if ($this->preload_attache) {
                $this->preload_attache->delete();
            }
        } else {
            $this->validate($this->rulesWithoutAttacheFile());
            $this->preload_attache->changeType(TaskFile::QR_ATTACHMENTS);
        }
        $this->updateTask();
        $this->updateBlocks();
    }


    public function isUploadedAttachment(): bool
    {
        return !$this->isNotUploadedAttachment();
    }

    public function isNotUploadedAttachment(): bool
    {
        return $this->preload_attache && get_class($this->attache) === get_class($this->preload_attache);
    }

    public function storeAttache()
    {
        $this->storeFile($this->attache, TaskFile::QR_ATTACHMENTS);
    }

    public function rulesWithAttacheFile(): array
    {
        return [
            'username'   => 'required|string|max:255',
            'password'   => 'required|string|max:255',
            'next_stage' => 'required|in:2,4',
            'attache'    => 'required|file|max:4194304',
        ];
    }

    public function rulesWithoutAttacheFile(): array
    {
        return [
            'username'   => 'required|string|max:255',
            'password'   => 'required|string|max:255',
            'next_stage' => 'required|in:2,4'
        ];
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
