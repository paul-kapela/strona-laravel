@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('passwords.change_password') }}</h1>

    @component('components.close-button', [
      'back' => true
    ])  
    @endcomponent
  </div>

  <form method="POST" action="{{ route('password.new') }}">
    @csrf

    <div class="flex flex-col space-y-5">
      @if ($errors->any())
        <div class="col-span-12 p-5 bg-red-400 rounded-xl">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <div class="flex items-center w-full">
        <label for="current_password" class="w-40 mr-2 inline-block font-semibold">{{ __('passwords.current_password') }}</label>
  
        <div class="flex w-full">
          <input
            id="current_password"
            type="password"
            class="input without-button w-full @error('current_password') error @enderror"
            name="current_password"
            required
          >
        </div>
      </div>
  
      <div class="flex items-center w-full">
        <label for="new_password" class="w-40 mr-2 inline-block font-semibold">{{ __('passwords.new_password') }}</label>
  
        <div class="flex w-full">
          <input
            id="new_password"
            type="password"
            class="input without-button w-full @error('new_password') error @enderror"
            name="new_password"
            required
          >
        </div>
      </div>
  
      <div class="flex items-center w-full">
        <label for="new_password_confirmation" class="w-40 mr-2 inline-block font-semibold">{{ __('passwords.confirm_password') }}</label>
  
        <div class="flex w-full">
          <input
            id="new_password_confirmation"
            type="password"
            class="input without-button w-full @error('new_password_confirmation') error @enderror"
            name="new_password_confirmation"
            required
          >
        </div>
      </div>
  
      <button type="submit" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full">
        {{ __('passwords.change') }}
      </button>
    </div>
  </form>
</div>
@endsection