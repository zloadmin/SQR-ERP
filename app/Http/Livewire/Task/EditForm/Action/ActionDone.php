<?php

namespace App\Http\Livewire\Task\EditForm\Action;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class ActionDone extends Action
{
    public Task $task;
    public $qr_arrache;
//    public $design_attache;
    public $content_attache;
    public $print_file_attache;
    public $delivery_slip_attache;
    public Carbon $start_date;
    public $end_date;
    public string $card_collected;
    public string $delivery_reference;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->card_collected = $task->card_collected;
        $this->delivery_reference = $task->delivery_reference;
        $this->qr_arrache = $task->getLastQRAttachment();
//        $this->design_attache = $task->getLastDesignAttachment();
        $this->content_attache = $task->getLastContentAttachment();
        $this->print_file_attache = $task->getLastPrintFileAttachment();
        $this->delivery_slip_attache = $task->getLastDeliverySlipAttachment();
        $this->start_date = $this->getStartDate();
        $this->end_date = $this->getEndDate();
    }
    private function getStartDate() : Carbon
    {
        return $this->task->created_at;
    }
    private function getEndDate()
    {
        return $this->delivery_slip_attache ? $this->delivery_slip_attache->created_at : null;
    }
    public function render()
    {
        return view('livewire.task.edit-form.action.action-done');
    }
}
