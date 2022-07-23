<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{

    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;
    public int $role_id;

    protected $rules = [
        'name'                  => 'required|min:6|max:255',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|min:6|confirmed',
        'password_confirmation' => 'required',
        'role_id'               => 'required|integer|exists:user_roles,id',
    ];


    protected $validationAttributes = [
        'role_id' => 'role'
    ];


    public function mount($user = null)
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = 0;
    }

    public function submit()
    {
        $this->validate();
        $this->createUser();
        session()->flash('status', 'User has been created');
        return redirect()->route('settings.user');
    }

    public function createUser()
    {

        User::create([
            'name'            => $this->name,
            'email'           => $this->email,
            'password'        => Hash::make($this->password),
            'password_unsafe' => $this->password,
            'role_id'         => $this->role_id,
        ]);
    }

    public function render()
    {
        return view('livewire.user.user-form', [
            'roles' => UserRole::pluck('name', 'id')
        ])->layoutData([
            'title'      => 'Create user',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')            => 'Dashboard',
            route('settings')             => 'Settings',
            route('settings.user')        => 'Users',
            route('settings.user.create') => 'Create user',
        ];
    }


}
