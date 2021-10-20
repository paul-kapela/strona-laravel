@extends('layouts.app')

@section('content')
<div class="lg:col-span-4"></div>

<div class="lg:col-span-4 col-span-12 p-5 rounded-border">
  <h1 class="mb-5 text-2xl font-semibold">{{ __('auth.reset_password') }}</h1>

  <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="flex flex-col space-y-5">
      @if (session('status'))
        <div class="p-5 bg-green-400 rounded-xl" role="alert">
          <h3>{{ session('status') }}</h3>
        </div>
      @endif

      @error('email')
        <div class="p-5 bg-red-400 rounded-xl" role="alert">
          <h3>{{ $message }}</strong>
        </div>
      @enderror

      <div>
        <label for="email" class="mb-2 inline-block font-semibold">{{ __('auth.email') }}</label>
  
        <div>
          <input
            id="email"
            type="email"
            class="input without-button w-full @error('email') error @enderror"
            name="email" value="{{ old('email') }}"
            required
            autocomplete="email"
            autofocus
          >
        </div>
      </div>
  
      <div class="w-full flex justify-end">
        <button type="submit" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full">
          {{ __('auth.send_reset_link') }}
        </button>
      </div>
    </div>
  </form>
</div>

<div class="lg:col-span-4"></div>
@endsection
