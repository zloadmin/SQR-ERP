<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class TagList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.tag.tag-list', [
            'tags' => Tag::paginate()
        ])->layoutData([
            'title'      => 'Tags',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($tag = Tag::find($id)) {
            $tag->delete();
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.tag')  => 'Tags',
        ];
    }

}
