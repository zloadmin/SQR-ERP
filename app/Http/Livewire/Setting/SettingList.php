<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class SettingList extends Component
{


    public function render()
    {
        return view('livewire.setting.setting-list', [ 'items' => $this->getItems() ])
            ->layoutData([
                'title'      => 'Settings',
                'breadcrumb' => $this->getIndexBreadcrumb()
            ]);
    }

    private function getItems() : array
    {
        return [
            [
                'title' => 'Role',
                'link'  => route('settings.user-role')
            ],
            [
                'title' => 'User',
                'link'  => route('settings.user')
            ]
        ];
    }

    private function getIndexBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
        ];
    }
}
