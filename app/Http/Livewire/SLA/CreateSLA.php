<?php

namespace App\Http\Livewire\SLA;

use App\Models\SLA;
use Livewire\Component;

class CreateSLA extends Component
{

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


    public function mount($user = null)
    {
        $this->name = '';
        $this->type = '';
        $this->stage = '';
        $this->time = 0;
    }

    public function submit()
    {
        $data = $this->validate();
        SLA::create($data);
        session()->flash('status', 'SLA has been created');
        return redirect()->route('settings.sla');
    }


    public function render()
    {
        return view('livewire.sla.sla-form')
            ->layoutData([
                'title'      => 'Create SLA',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.sla')        => 'SLA',
            route('settings.sla.create') => 'Create SLA',
        ];
    }

}
