<?php

namespace App\Http\Livewire\EmailAlert;

use App\Models\EmailAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditEmailAlert extends Component
{
    public EmailAlert $emailAlert;
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

    public function mount(EmailAlert $emailAlert)
    {

        $this->emailAlert = $emailAlert;
        $this->name = $emailAlert->name;
        $this->type = $emailAlert->type;
        $this->stage_id = $emailAlert->stage_id;
        $this->recipient_id = $emailAlert->recipient_id;
        $this->subject = $emailAlert->subject;;
        $this->text = $emailAlert->subject;;
    }

    public function submit()
    {
        $data = $this->validate();
        $this->emailAlert->update($data);
//        $this->updateEmailAlert();
        session()->flash('status', 'Email alert has been updated');
        return redirect()->route('settings.emailalert');
    }

//    public function updateEmailAlert()
//    {
//        $this->emailAlert->name = $this->name;
//        $this->emailAlert->type = $this->type;
//        $this->emailAlert->stage_id = $this->stage_id ? intval($this->stage_id) : null;
//
//        $this->emailAlert->recipient_id = $this->recipient_id;
//        $this->emailAlert->subject = $this->subject;
//        $this->emailAlert->text = $this->text;
//        $this->emailAlert->update();
//    }
    public function render()
    {
        return view('livewire.email-alert.email-alert-form')
            ->layoutData([
                'title'      => 'Edit email alert',
                'breadcrumb' => $this->getBreadcrumb()
            ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')           => 'Dashboard',
            route('settings')            => 'Settings',
            route('settings.emailalert') => 'Email Alert',
            route('settings.emailalert.create', $this->emailAlert) => 'Edit email alert',
        ];
    }
}
