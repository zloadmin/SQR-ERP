<?php

namespace App\Http\Livewire\SLA;

use App\Models\SLA;
use Livewire\Component;

class EditSLA extends Component
{
    public SLA $sla;
    public string $name;
    public string $type;
    public int $stage_id;
    public int $time;
    public  $time_minutes = 0;
    public  $time_hours = 0;
    public  $time_days = 0;


    protected $rules = [
        'name'         => 'required|max:255',
        'type'         => 'required',
        'stage_id'     => 'required|integer|exists:stages,id',
        'time_minutes' => 'required|integer|min:0',
        'time_hours'   => 'required|integer|min:0',
        'time_days'    => 'required|integer|min:0',
    ];
//    protected $messages = [
//        'time.min' => 'The time field is required.',
//    ];

    protected $validationAttributes = [
        'stage_id' => 'stage'
    ];

    public function mount(SLA $sla)
    {

        $this->name = $sla->name;
        $this->type = $sla->type;
        $this->stage_id = $sla->stage_id;
        $this->time = $sla->time;
        $this->time_days = $sla->time_days;
        $this->time_hours = $sla->time_hours;
        $this->time_minutes = $sla->time_minutes;
    }

    public function submit()
    {
        $this->validate();
        $this->updateSla();
        session()->flash('status', 'SLA has been updated');
        return redirect()->route('settings.sla');
    }
    public function updateSla()
    {
        $this->sla->name = $this->name;
        $this->sla->type = $this->type;
        $this->sla->stage_id = $this->stage_id;
        $this->sla->time = ($this->time_days * (60 * 60 * 24)) + ($this->time_hours * (60 * 60)) + ($this->time_minutes * 60);
        $this->sla->update();
    }

    public function render()
    {
        return view('livewire.sla.sla-form')
            ->layoutData([
                'title'      => 'Edit SLA ' . $this->sla->name,
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                     => 'Dashboard',
            route('settings')                      => 'Settings',
            route('settings.sla')                  => 'SLA',
            route('settings.sla.edit', $this->sla) => 'Edit SLA ' . $this->sla->name,
        ];
    }
}
