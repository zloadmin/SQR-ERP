<?php

namespace App\Http\Livewire\TelegramAlert;

use App\Models\TelegramAlert;
use App\Models\WebHook;
use Livewire\Component;

class EditTelegramAlert extends Component
{
    public TelegramAlert $telegramAlert;
    public string $name;
    public $stage_id;
    public array $variables;

    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'stage_id' => ['required', 'exists:stages,id'],
            'variables' => ['required'],
        ];
    }

    public function mount(TelegramAlert $telegramAlert)
    {
        $this->telegramAlert = $telegramAlert;
        $this->name = $telegramAlert->name;
        $this->stage_id = $telegramAlert->stage_id;
        $this->variables = $telegramAlert->variables;
    }

    public function submit()
    {
        $data = $this->validate();
        $this->telegramAlert->update($data);
        session()->flash('status', 'Telegram Alert has been created');
        return redirect()->route('settings.telegram_alert');
    }

    public function render()
    {
        return view('livewire.telegram-alert.telegram-alert-form')
            ->layoutData([
                'title'      => 'Edit Telegram Alert',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.telegram_alert') => 'Telegram Alert',
            route('settings.telegram_alert.edit', $this->telegramAlert) => 'Edit Telegram Alert',
        ];
    }
}
