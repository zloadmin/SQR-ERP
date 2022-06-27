<?php

namespace App\Http\Livewire\SLA;

use App\Models\SLA;
use Livewire\Component;

class EditSLA extends Component
{
    public SLA $sla;
    public string $name;
    public string $type;
    public string $stage;
    public int $time;


    protected $rules = [
        'name'  => 'required|max:255',
        'type'  => 'required',
        'stage' => 'required',
        'time'  => 'required|integer|min:1',
    ];
    protected $messages = [
        'time.min' => 'The time field is required.',
    ];


    public function mount(SLA $sla)
    {

        $this->name = $sla->name;
        $this->type = $sla->type;
        $this->stage = $sla->stage;
        $this->time = $sla->time;

    }

    public function submit()
    {
        $data = $this->validate();
        $this->sla->update($data);
        session()->flash('status', 'SLA has been updated');
        return redirect()->route('settings.sla');
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
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.sla')        => 'SLA',
            route('settings.sla.edit', $this->sla) => 'Edit SLA ' . $this->sla->name,
        ];
    }
}
