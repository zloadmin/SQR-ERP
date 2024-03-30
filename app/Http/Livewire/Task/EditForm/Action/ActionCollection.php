<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Inventory;
use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ActionCollection extends Action
{
    use WithFileUploads;

    public $delivery_slip;
    public bool $delivery_slip_attached;
    public $image_of_printed_cards;
    public $attache;
    public string $card_collected = '';
    public string $delivery_reference = '';
    public Task $task;
    public bool $editable;
    public Collection $inventories;
    public array $inventory_used;


    protected $rules = [
        'delivery_reference' => 'required|string|max:255',
        'attache'            => 'required|file|max:4194304',
        'inventory_used.*'   => 'required|int|min:1|max:100000'
    ];

    protected function rules()
    {
        $rules = [];
//        $rules['delivery_reference'] = ['required', 'string', 'max:255'];
//        if ($this->isNeedDeliverySlipAttached()) {
//            $rules['delivery_slip'] = ['required', 'file', 'max:4194304'];
//        } else {
//            $rules['delivery_slip'] = ['nullable'];
//        }
//        $rules['image_of_printed_cards'] = ['required', 'file', 'max:4194304'];
        $rules['inventory_used'] = ['required', 'array', 'min:2'];
        foreach ($this->inventories as $inventory) {
            $rules['inventory_used.' . $inventory->id] = ['int', 'min:1', 'max:100000'];
        }
        return $rules;
    }

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->editable = $this->getEditable($task);
        $this->card_collected = $task->card_collected ?? '';
        $this->delivery_reference = $task->delivery_reference ?? '';
        $this->inventories = Inventory::query()->latest()->get();
        $this->inventory_used = [];
        $delivery_slip = $this->task->getLastDeliverySlipAttachment();
        if ($delivery_slip && $delivery_slip->is_aramex) {
            $this->delivery_slip = $delivery_slip;
        }
    }

    public function submitDeliverySlip()
    {

        if ($this->isRequiredMaterial()) {
            return $this->setRequiredMaterialError();
        }

        $this->validate();
//        $this->storeAttachments();
        $this->updateTask();
        $this->updateInventories();
        $this->updateBlocks();
    }

    public function isNeedDeliverySlipAttached(): bool
    {

        return is_object($this->delivery_slip) && get_class($this->delivery_slip) != TaskFile::class;
    }

    public function storeAttachments()
    {
        if ($this->isNeedDeliverySlipAttached()) {
            $this->storeDeliverySlip();
        }
        $this->storeImageOfPrintedCards();
    }

    public function storeDeliverySlip()
    {
        $this->storeFile($this->delivery_slip, TaskFile::DELIVERY_SLIP_ATTACHMENTS);
    }

    public function storeImageOfPrintedCards()
    {
        $this->storeFile($this->image_of_printed_cards, TaskFile::IMAGE_OF_PRINTED_CARDS_ATTACHMENTS);
    }

    public function updateInventories()
    {
        foreach ($this->inventory_used as $inventory_id => $used) {
            $inventory = Inventory::find($inventory_id);
            if ($inventory && intval($used)) {
                $inventory->increaseUsed($used);
            }
        }
    }

    public function updateTask()
    {
//        $this->task->card_collected = $this->card_collected;
        $this->task->delivery_reference = $this->delivery_reference;
        $this->task->stage_id = $this->task->getNextStageId();
        $this->task->inventory_used = Inventory::getInventoryUsedTaskArray($this->inventory_used);
        $this->task->update();
    }

    public function render()
    {
        return view('livewire.task.edit-form.action.action-collection');
    }
}
