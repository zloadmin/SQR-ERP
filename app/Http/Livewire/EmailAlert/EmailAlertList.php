<?php

namespace App\Http\Livewire\EmailAlert;

use App\Models\EmailAlert;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class EmailAlertList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        return view('livewire.email-alert.email-alert-list', [
            'email_alerts' => EmailAlert::paginate()
        ])->layoutData([
            'title'      => 'Email Alert',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    public function delete(int $id)
    {
        if ($alert = EmailAlert::find($id)) {
            $alert->delete();
            session()->flash('warning', 'Alert has been deleted');
        }
    }
    private function getBreadcrumb()
    {
        return [
            route('dashboard') => 'Dashboard',
            route('settings')  => 'Settings',
            route('settings.emailalert')  => 'Email Alert',
        ];
    }

}
