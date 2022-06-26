<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component
{

    public User $user;

    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;
    public int $role_id;




    protected $validationAttributes = [
        'role_id' => 'role'
    ];


    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = $user->role_id;

    }

    public function submit()
    {
        $this->validate();
        $this->updateUser();

        session()->flash('status', 'User has been updated');
        return redirect()->route('settings.user');
    }

    public function updateUser()
    {
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->role_id = $this->role_id;
        if ($this->password) {
            $this->user->password = Hash::make($this->password);
            $this->user->password_unsafe = $this->password;
        }
        $this->user->update();

    }


    public function render()
    {
        return view('livewire.user.user-form', [
            'roles' => UserRole::pluck('name', 'id')
        ])->layoutData([
            'title'      => 'Edit user',
            'breadcrumb' => $this->getBreadcrumb()
        ]);
    }

    private function getBreadcrumb()
    {
        return [
            route('dashboard')                       => 'Dashboard',
            route('settings')                        => 'Settings',
            route('settings.user')                   => 'Users',
            route('settings.user.edit', $this->user) => 'Edit user '
        ];
    }
    public function rules() : array
    {
        return [
            'name'     => 'required|min:6|max:255',
            'email'    => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'min:6|confirmed',
            'role_id'  => 'required|integer|exists:user_roles,id',
        ];
    }

}
