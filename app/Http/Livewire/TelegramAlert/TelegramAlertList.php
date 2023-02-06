<?php

namespace App\Http\Livewire\TelegramAlert;

use App\Models\TelegramAlert;
use App\Models\WebHook;
use Livewire\Component;
use Livewire\WithPagination;

class TelegramAlertList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.telegram-alert.telegram-alert-list', [
            'telegram_alerts' => TelegramAlert::paginate()
        ])->layoutData([
            'title'      => 'Telegram Alert',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($alert = TelegramAlert::find($id)) {
            $alert->delete();
            session()->flash('warning', 'Telegram alert has been deleted');
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.telegram_alert')  => 'Telegram Alert',
        ];
    }

}
