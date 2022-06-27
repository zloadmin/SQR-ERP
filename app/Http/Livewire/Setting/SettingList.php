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
                'breadcrumb' => $this->getBreadcrumb()
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
            ],
            [
                'title' => 'SLA',
                'link'  => route('settings.sla')
            ]
        ];
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
        ];
    }
}
