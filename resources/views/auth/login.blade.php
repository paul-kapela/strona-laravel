@extends('layouts.app')

@section('content')
<div class="lg:col-span-4"></div>

<div class="lg:col-span-4 col-span-12 p-5 rounded-border">
  <h1 class="mb-5 text-2xl font-semibold">{{ __('auth.login') }}</h1>

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="flex flex-col space-y-5">
      @if ($errors->has('username') || $errors->has('email'))
        <div class="p-5 bg-red-400 rounded-xl">
          <h3>{{ $errors->first('username') ?: $errors->first('email') }}</h3>
        </div>
      @endif

      <!-- Username or e-mail -->
      <div>
        <label for="login" class="mb-2 inline-block font-semibold">
          {!! __('auth.username_or_email') !!}
        </label>
    
        <div>
          <input
            id="login"
            type="text"
            class="input without-button w-full {{ $errors->has('username') || $errors->has('email') ? ' error' : '' }}"
            name="login" value="{{ old('username') ?: old('email') }}"
            required
            autofocus
          >
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
      <div>
        <label for="password" class="mb-2 inline-block font-semibold">{{ __('auth.password') }}</label>
  
        <div>
          <input
            id="password"
            type="password"
            class="input without-button w-full"
            name="password"
            required
            autocomplete="current-password"
          >
        </div>
      </div>
  
      <!-- Remember -->
      <div class="flex items-center w-full">
        <input type="checkbox" id="remember" name="remember" class="opacity-0 absolute h-4 w-4" {{ old('remember') ? 'checked' : '' }}/>

        <div class="border-2 rounded-md border-gray-800 dark:border-gray-200 w-4 h-4 flex flex-shrink-0 justify-center items-center mr-2">
          <svg class="text-gray-800 dark:text-gray-200 hidden w-2 h-2 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" fill-rule="evenodd">
              <g transform="translate(-9 -11)" fill="currentColor" fill-rule="nonzero">
                <path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" />
              </g>
            </g>
          </svg>
        </div>

        <label for="remember" class="select-none">{{ __('auth.remember_me') }}</label>
      </div>
  
      <!-- Login - submit button -->
      <div class="w-full flex justify-end space-x-2">
        <button type="submit" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full">
          {{ __('auth.login') }}
        </button>

        @if (Route::has('password.request'))
          <a class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full" href="{{ route('password.request') }}">
            {{ __('auth.reset_password') }}
          </a>
        @endif
      </div>
    </div>
  </form>
</div>

<div class="lg:col-span-4"></div>
@endsection
