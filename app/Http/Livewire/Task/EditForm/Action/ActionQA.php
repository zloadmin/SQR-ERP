<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionQA extends Action
{

    public Task $task;
    public bool $editable;
    public array $orders = [];
    public array $cards = [];

    public $comment;
    protected $rules = [
        'comment' => 'required'
    ];

    public function mount(Task $task, bool $guest = false)
    {
        $this->task = $task;
        $this->editable = $guest || $this->getEditable($task);
        $this->comment = '';
    }

    public function approve()
    {

        $this->increaseTaskStageId();
        $this->updateBlocks();
    }

    public function isAllChecked(): bool
    {

        return $this->isCardsChecked() && $this->isOrdersChecked();
    }

    private function isCardsChecked() : bool
    {
        return $this->isCheckedAllByArray(Task::QA_CARDS, $this->cards);
    }

    private function isOrdersChecked(): bool
    {
        return $this->isCheckedAllByArray(Task::QA_ORDERS, $this->orders);
    }

    private function isCheckedAllByArray(array $original, array $checked): bool
    {
        foreach ($original as $id => $value) {
            if (!in_array($id, $checked)) {
                return false;
            }
        }
        return true;
    }

    public function saveForm()
    {
        $this->task->update([
            'qa_comment' => $this->comment,
        ]);
    }

    public function decline()
    {
        $this->validate();
        $this->saveForm();
        $this->decreaseTaskStageId();
        $this->updateBlocks();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-qa');
    }
}
