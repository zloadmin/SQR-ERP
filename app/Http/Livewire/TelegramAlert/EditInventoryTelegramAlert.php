<?php

namespace App\Http\Livewire\TelegramAlert;

use App\Models\TelegramAlert;
use App\Models\WebHook;
use Livewire\Component;

class EditInventoryTelegramAlert extends Component
{
    public TelegramAlert $telegramAlert;
    public string $name;
    public ?int $inventory_id;
    public  $available_less_then;
    public string $text;
    public array $recipient_ids;

    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'inventory_id' => ['required', 'exists:inventories,id'],
            'available_less_then' => ['required', 'int', 'min:1'],
            'text' => ['required'],
            'recipient_ids' => ['required', 'array'],
        ];
    }
    protected $messages = [
        'recipient_ids.required' => 'The recipient field is required.',
    ];




    public function mount(TelegramAlert $telegramAlert)
    {
        $this->telegramAlert = $telegramAlert;
        $this->name = $telegramAlert->name;
        $this->inventory_id = $telegramAlert->inventory_id;
        $this->available_less_then = $telegramAlert->available_less_then;
        $this->text = $telegramAlert->text;
        $this->recipient_ids = $telegramAlert->recipient_ids;
    }

    public function submit()
    {
        $data = $this->validate();
        $this->telegramAlert->update($data);
        session()->flash('status', 'Telegram Inventory Alert has been created');
        return redirect()->route('settings.telegram_alert');
    }

    public function render()
    {
        return view('livewire.telegram-alert.telegram-alert-inventory-form')
            ->layoutData([
                'title'      => 'Edit Telegram Inventory Alert',
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
