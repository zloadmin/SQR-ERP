<?php

namespace App\Http\Livewire\TelegramAlert;

use App\Models\EmailAlert;
use App\Models\TelegramAlert;
use App\Models\WebHook;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateTelegramAlert extends Component
{
    public string $name;
    public int $stage_id;
    public string $text;
    public array $recipient_ids;

    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'stage_id' => ['required', 'exists:stages,id'],
            'text' => ['required'],
            'recipient_ids' => ['required', 'array'],
        ];
    }
    protected $messages = [
        'recipient_ids.required' => 'The recipient field is required.',
    ];


    public function mount()
    {
        $this->name = '';
        $this->stage_id = 1;
        $this->text = '';
        $this->recipient_ids = [];
    }

    public function submit()
    {
        $data = $this->validate();
        TelegramAlert::create($data);
        session()->flash('status', 'Telegram alert has been created');
        return redirect()->route('settings.telegram_alert');
    }

    public function render()
    {
        return view('livewire.telegram-alert.telegram-alert-form')
            ->layoutData([
                'title'      => 'Create Telegram Alert',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.telegram_alert') => 'Telegram Alert',
            route('settings.telegram_alert.create') => 'Create Telegram Alert',
        ];
    }

}
