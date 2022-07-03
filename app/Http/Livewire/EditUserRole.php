<?php

namespace App\Http\Livewire;


use App\Models\UserRole;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditUserRole extends Component
{
    public UserRole $userRole;
    public array $access_fields;
    public string $success_message;


    public function mount(UserRole $userRole)
    {

        $this->userRole = $userRole;
        foreach (UserRole::getAccessFieldNames() as $key => $data) {
            $this->access_fields[$key] = $userRole->{$key};
        }
    }
    public function editUserRole()
    {
        $this->updateUserRole();
    }

    public function updateUserRole()
    {
        foreach (UserRole::getAccessFieldNames() as $key => $data) {
            $this->userRole->$key = (bool)$this->access_fields[$key];
        }
        $this->userRole->update();
        $this->userRole->refresh();
    }

    public function render()
    {
        return view('livewire.edit-user-role');
    }
}
