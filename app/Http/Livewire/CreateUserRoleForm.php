<?php

namespace App\Http\Livewire;

use App\Models\UserRole;
use Livewire\Component;

class CreateUserRoleForm extends Component
{
    public string $name;
    protected array $rules = [
        'name' => 'required|min:1|unique:user_roles',
    ];

    public function render()
    {
        return view('livewire.create-user-role-form');
    }
    public function update()
    {
        $this->validate();
    }
    public function submit()
    {
        $this->validate();
        UserRole::create([ 'name' => $this->name ]);
        session()->flash('status', 'Role has been created');
        return redirect()->route('settings.user-role');
    }
}
