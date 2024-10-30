<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

class SettingList extends Component
{


    public function render()
    {
        return view('livewire.setting.setting-list', ['items' => $this->getItems()])
            ->layoutData([
                'title'      => 'Settings',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getItems(): array
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
            ],
            [
                'title' => 'SLA expired colors',
                'link'  => route('settings.sla-expired-color')
            ],
            [
                'title' => 'Tag',
                'link'  => route('settings.tag')
            ],
            [
                'title' => 'Email Alert',
                'link'  => route('settings.emailalert')
            ],
            [
                'title' => 'WebHook',
                'link'  => route('settings.webhook')
            ],
            [
                'title' => 'Telegram Alert',
                'link'  => route('settings.telegram_alert')
            ],
            [
                'title' => 'Inventory',
                'link'  => route('settings.inventory-list')
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
