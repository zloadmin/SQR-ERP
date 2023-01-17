<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;

class EditTag extends Component
{
    public Tag $tag;
    public string $name;
    protected $rules = [
        'name' => ['required', 'max:255'],
        'color' => ['required', "regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i"]
    ];

    public function mount(Tag $tag)
    {

        $this->name = $tag->name;
        $this->color = $tag->color;
        $this->tag = $tag;
    }

    public function submit()
    {
        $data = $this->validate();
        $this->tag->update($data);
        session()->flash('status', 'Tag has been updated');
        return redirect()->route('settings.tag');
    }


    public function render()
    {
        return view('livewire.tag.tag-form')
            ->layoutData([
                'title'      => 'Edit Tag ' . $this->tag->name,
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.tag')        => 'SLA',
            route('settings.tag.edit', $this->tag) => 'Edit Tag ' . $this->tag->name,
        ];
    }
}
