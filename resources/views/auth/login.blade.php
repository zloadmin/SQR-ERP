@extends('layouts.card')
@section('title', 'Sign In')
@section('content')
    <div class="card-body p-4">
        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
            <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email_address">Email address</label>
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" id="email_address" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted float-right">
                        <small>Forgot your password?</small>
                    </a>
                @endif
                <label for="password">Password</label>
                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" placeholder="Enter your password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mb-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Remember me</label>
                </div>
            </div>

            <div class="form-group mb-0 text-center">
                <button class="btn btn-primary" type="submit"> Log In </button>
            </div>

        </form>
    </div>
@endsection
