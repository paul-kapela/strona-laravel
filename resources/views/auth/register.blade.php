@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('auth.signup') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <!-- <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div> -->

            <!-- Surname -->
            <!-- <div class="form-group row">
              <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

              <div class="col-md-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                @error('surname')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div> -->

            <!-- Username -->
            <div class="form-group row">
              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('auth.username') }}</label>

              <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- E-mail -->
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- Password -->
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <!-- Password confirmation -->
            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth.repeat_password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

            <!-- Captcha -->
            <div class="form-group row">
              <label for="captcha" class="col-md-4 col-form-label text-md-right">{{ __('auth.confirm_identity') }}</label>

              <div class="col-md-6">
                <input
                  id="captcha"
                  type="text"
                  name="captcha"
                  class="mb-3 w-100 form-control @error('captcha') is-invalid @enderror"
                >
  
                <div class="w-100 d-flex align-items-center alert alert-primary">
                  <p class="mr-3">{{ __('auth.captcha') }}: </p>

                  {!! Captcha::img('inverse') !!}
                </div>
              </div>
            </div>

            <!-- Register - submit button -->
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <!-- Accept terms and conditions -->

                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="tos-check" name="tos-check" required>
                  <label for="tos-check" class="form-check-label">{{ __('tos.know_and_accept').lcfirst(__('tos.tos')).'.' }}</label>
                </div>

                <button type="submit" class="btn btn-primary">
                  {{ __('auth.signup') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
