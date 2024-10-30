<?php

namespace App\Http\Livewire\SLAColorExpired;

use App\Models\SLA;
use App\Models\SlaExpiredColor;
use Livewire\Component;

class EditSlaExpiredColor extends Component
{
    public SlaExpiredColor $slaExpiredColor;
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
        'time_hours'   => 'required|integer|min:0',
        'time_days'    => 'required|integer|min:0',
        'color'        => ['required', 'regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i']
    ];



    public function mount(SlaExpiredColor $slaExpiredColor)
    {
        $this->slaExpiredColor = $slaExpiredColor;
        $this->name = $slaExpiredColor->name;
        $this->stage_id = $slaExpiredColor->stage_id;
        $this->time_days = $slaExpiredColor->time_days;
        $this->time_hours = $slaExpiredColor->time_hours;
        $this->color = $slaExpiredColor->color;
    }

    public function submit()
    {
        $this->validate();
        $this->updateSlaExpiredColor();
        session()->flash('status', 'SLA expired color has been updated');
        return redirect()->route('settings.sla-expired-color');
    }


    public function render()
    {
        return view('livewire.sla-expired-color.sla-expired-color-form')
            ->layoutData([
                'title'      => 'Edit SLA expired color ' . $this->slaExpiredColor->name,
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                                               => 'Dashboard',
            route('settings')                                                => 'Settings',
            route('settings.sla-expired-color')                              => 'SLA expired colors',
            route('settings.sla-expired-color.edit', $this->slaExpiredColor) => 'Edit SLA expired color ' . $this->slaExpiredColor->name,
        ];
    }

    private function updateSlaExpiredColor(): void
    {
        $this->slaExpiredColor->name = $this->name;
        $this->slaExpiredColor->stage_id = $this->stage_id;
        $this->slaExpiredColor->time = $this->time_days * 24 + $this->time_hours;
        $this->slaExpiredColor->color = $this->color;
        $this->slaExpiredColor->update();
    }
}
