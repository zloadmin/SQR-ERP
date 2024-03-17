<?php

namespace App\Http\Livewire;

use App\Models\EmailCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginPage extends Component
{
    const STEP_AUTH = 'auth';
    const STEP_CODE = 'code';
    public string $step;
    public ?User $user;
    public string $sent_code;
    public string $code = '';
    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    public array $credentials = [];

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required'
    ];


    public function mount()
    {
        $this->step = self::STEP_AUTH;
    }

    public function setCredentials()
    {
        $this->credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];
    }

    public function getUser(): ?User
    {
        $user = User::where('email', $this->email)->first();
        return $user && Hash::check($this->password, $user->password) ? $user : null;
    }

    public function login()
    {
        $this->validate();
        $user = $this->getUser();
        if ($user) {
            $this->goToCodeStep($user);
        } else {
            $this->addError('email', __('auth.failed'));
        }

    }

    public function goToCodeStep(User $user)
    {
        $this->user = User::where('email', $this->email)->first();
        $this->sent_code = EmailCode::sendCode($this->user);
        $this->step = self::STEP_CODE;
    }

    public function sendCode()
    {
        if($this->code == $this->sent_code) {
            Auth::login($this->user);
            return redirect()->route('dashboard');
        } else {
            $this->addError('code', 'Wrong code');
        }
    }

    public function render()
    {
        return view('livewire.login-page')
            ->layout('layouts.card-livewire')
            ->layoutData([ 'title' => 'Sign In' ]);
    }
}
