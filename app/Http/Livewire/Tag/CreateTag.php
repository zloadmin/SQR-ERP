<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;

class CreateTag extends Component
{
    public string $name;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function mount()
    {
        $this->name = '';
    }

    public function submit()
    {
        $data = $this->validate();
        Tag::create($data);
        session()->flash('status', 'Tag has been created');
        return redirect()->route('settings.tag');
    }


    public function render()
    {
        return view('livewire.tag.tag-form')
            ->layoutData([
                'title'      => 'Create tag',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.tag')        => 'Tags',
            route('settings.tag.create') => 'Create tag',
        ];
    }

}
