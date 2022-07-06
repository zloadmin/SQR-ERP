<?php

namespace App\Http\Livewire\EmailAlert;

use App\Models\EmailAlert;
use App\Models\Stage;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateEmailAlert extends Component
{
    public string $name;
    public string $type;
    public int $stage_id;
    public int $recipient_id;
    public string $subject;
    public string $text;

    protected function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'type' => ['required', Rule::in(EmailAlert::TYPES)],
            'stage_id' => ['required', 'exists:stages,id'],
            'recipient_id' => ['required', 'integer'],
            'subject' => ['required', 'max:255'],
            'text' => ['required'],
        ];
    }

    public function mount()
    {
        $this->name = '';
        $this->type = EmailAlert::TYPE_CREATE;
        $this->stage_id = 1;
        $this->recipient_id = 0;
        $this->subject = '';
        $this->text = '';
    }

    public function submit()
    {
        $data = $this->validate();
        EmailAlert::create($data);
        session()->flash('status', 'Email alert has been created');
        return redirect()->route('settings.emailalert');
    }
//    public function createEmailAlert()
//    {
//        EmailAlert::create([
//            'name' => $this->name,
//            'type' => $this->type,
//            'stage_id' => $this->stage_id ? intval($this->stage_id) : null,
//            'recipient_id' => $this->recipient_id,
//            'subject' => $this->subject,
//            'text' => $this->text,
//        ]);
//    }


    public function render()
    {
        return view('livewire.email-alert.email-alert-form')
            ->layoutData([
                'title'      => 'Create email alert',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.emailalert') => 'Email Alert',
            route('settings.emailalert.create') => 'Create email alert',
        ];
    }
//    public function render()
//    {
//        return view('livewire.email-alert.create-email-alert');
//    }
}
