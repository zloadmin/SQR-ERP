<?php

namespace App\Http\Livewire\WebHook;

use App\Models\WebHook;
use Livewire\Component;
use Livewire\WithPagination;

class WebHookList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.web-hook.webhook-list', [
            'web_hooks' => WebHook::paginate()
        ])->layoutData([
            'title'      => 'WebHook',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($alert = WebHook::find($id)) {
            $alert->delete();
            session()->flash('warning', 'WebHook has been deleted');
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.webhook')  => 'WebHook',
        ];
    }

}
