<?php

namespace App\Http\Livewire\Email;

use App\Models\Email;
use Livewire\Component;

class EmailList extends Component
{

    public function render()
    {
        return view('livewire.email.email-list', [
            'emails' => Email::with('alert')->latest()->paginate()
        ])->layoutData([
            'title'      => 'Emails',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }


    private function getBreadcrumb()
    {
        return [
//            route('dashboard') => 'Dashboard',
//            route('emails')  => 'Emails',
        ];
    }

}
