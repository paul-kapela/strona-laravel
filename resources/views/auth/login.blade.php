@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zaloguj się') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username or e-mail -->
                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">
                                Nazwa użytkownika lub&nbsp;adres e-mail
                            </label>
                        
                            <div class="col-md-6">
                                <input id="login" type="text"
                                    class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                        
                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- E-mail -->
                        <!-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember -->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Nie wylogowuj') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Login - submit button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zaloguj') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Przywróć hasło') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
