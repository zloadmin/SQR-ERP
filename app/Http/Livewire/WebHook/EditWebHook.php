<?php

namespace App\Http\Livewire\WebHook;

use App\Models\WebHook;
use Livewire\Component;

class EditWebHook extends Component
{
    public WebHook $webHook;
    public string $name;
    public string $url;
    public $stage_id;
    public array $variables;

    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'url' => ['required', 'url'],
            'stage_id' => ['nullable', 'integer', 'exists:stages,id'],
            'variables' => ['required'],
        ];
    }

    public function mount(WebHook $webHook)
    {
        $this->webHook = $webHook;
        $this->name = $webHook->name;
        $this->url = $webHook->url;
        $this->stage_id = $webHook->stage_id;
        $this->variables = $webHook->variables;
    }

    public function submit()
    {
        $data = $this->validate();
        $data['stage_id'] = $data['stage_id'] > 0 ? intval($data['stage_id']) : null;
        $this->webHook->update($data);
        session()->flash('status', 'Webhook has been created');
        return redirect()->route('settings.webhook');
    }

    public function render()
    {
        return view('livewire.web-hook.webhook-form')
            ->layoutData([
                'title'      => 'Edit WebHook',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.webhook') => 'WebHook',
            route('settings.webhook.edit', $this->webHook) => 'Edit WebHook',
        ];
    }
}
