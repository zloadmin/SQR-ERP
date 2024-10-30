<?php

namespace App\Http\Livewire\SLAColorExpired;

use App\Models\SLA;
use App\Models\SlaExpiredColor;
use Livewire\Component;

class CreateSlaExpiredColor extends Component
{

    public string $name;
    public int $stage_id;
    public int $time;
    public $time_minutes = 0;
    public $time_hours = 0;
    public $time_days = 0;
    public string $color;

    protected $rules = [
        'name'         => 'required|max:255',
        'stage_id'     => 'required|integer|exists:stages,id',
        'time_minutes' => 'required|integer|min:0',
        'time_hours'   => 'required|integer|min:0',
        'time_days'    => 'required|integer|min:0',
        'color'        => ['required', 'regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i']
    ];


    public function mount($user = null)
    {
        $this->name = '';
        $this->stage_id = 0;
        $this->time_days = 0;
        $this->time_hours = 0;
        $this->time_minutes = 0;
        $this->color = '#ffffff';
    }

    public function submit()
    {
        $this->validate();
        SlaExpiredColor::create([
            'name'     => $this->name,
            'stage_id' => $this->stage_id,
            'time'     => ($this->time_days * (60 * 60 * 24)) + ($this->time_hours * (60 * 60)) + ($this->time_minutes * 60),
            'color'    => $this->color
        ]);
        session()->flash('status', 'SLA expired color has been created');
        return redirect()->route('settings.sla-expired-color');
    }


    public function render()
    {
        return view('livewire.sla-expired-color.sla-expired-color-form')
            ->layoutData([
                'title'      => 'Create SLA expired color',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                         => 'Dashboard',
            route('settings')                          => 'Settings',
            route('settings.sla-expired-color')        => 'SLA expired colors',
            route('settings.sla-expired-color.create') => 'Create SLA expired color',
        ];
    }

}
