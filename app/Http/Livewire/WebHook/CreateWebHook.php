<?php

namespace App\Http\Livewire\WebHook;

use App\Models\EmailAlert;
use App\Models\Stage;
use App\Models\WebHook;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateWebHook extends Component
{
    public string $name;
    public string $url;
    public ?int $stage_id;
    public array $variables;

    protected function rules()
    {
//        dd(Stage::getAllStageIds(), $this->stage_id);
//        dd([
//            'name' => ['required', 'max:255'],
//            'url' => ['required', 'url'],
//            'stage_id' => ['required',
//                Rule::in(Stage::getAllStageIds()),
//            ],
//            'variables' => ['required'],
//        ]);

        return [
            'name' => ['required', 'max:255'],
            'url' => ['required', 'url'],
//            'stage_id' => ['required',
//                Rule::in(Stage::getAllStageIds()),
//            ],
            'stage_id' => ['nullable', 'exists:stages,id'],
            'variables' => ['required'],
        ];
    }

    public function mount()
    {
        $this->name = '';
        $this->url = '';
        $this->stage_id = null;
        $this->variables = [];
    }

    public function submit()
    {
        $data = $this->validate();

        WebHook::create($data);
        session()->flash('status', 'Webhook has been created');
        return redirect()->route('settings.webhook');
    }

    public function render()
    {
        return view('livewire.web-hook.webhook-form')
            ->layoutData([
                'title'      => 'Create WebHook',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.webhook') => 'WebHook',
            route('settings.webhook.create') => 'Create WebHook',
        ];
    }

}
