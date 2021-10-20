@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
      <h1 class="mr-auto text-2xl font-semibold">{{ __('profile.edit').' '.lcfirst(__('profile.profile')) }}</h1>

      @component('components.close-button', [
        'back' => true
      ])
      @endcomponent
  </div>

  <form action="{{ route('users.update', $user) }}" entype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')

    <div class="flex flex-col space-y-5">
      <div class="flex items-center w-full">
        <img src="{{ $user->profileImage() }}" class="w-20 mr-5 rounded-circle">
    
        <input
          type="text"
          class="input without-button w-full {{ $errors->has('username') ? ' error' : '' }}"
          name="username"
          value={{ old('username') ?? $user->username }}
          maxlength="30"
          autofocus
        >
      </div>

      @if ($errors->any())
        <div class="p-5 bg-red-400 rounded-xl">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="flex items-center w-full">
        <label for="email" class="w-20 mr-2 inline-block font-semibold">{{ __('profile.email')}}</label>
      
        <div class="flex w-full">
          <input  
            id="email"
            type="text"
            class="input w-full @error('email') error @enderror"
            name="email"
            value="{{ old('email') ?? $user->email }}"
            maxlength="50"
            placeholder="email@example.com"
            required
          >
      
          <input
            id="email_show"
            type="checkbox"
            name="email_show"
            {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
            value="0"
            hidden
          >
      
          <label class="input-button" for="email_show">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 checked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 unchecked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
          </label>
        </div>
      </div>
    
      <div class="flex items-center w-full">
        <label for="phone" class="w-20 mr-2 inline-block font-semibold">{{ __('profile.phone') }}</label>
      
        <div class="flex w-full">
          <input
            id="phone"
            type="tel"
            class="input w-full @error('phone') error @enderror"
            name="phone"
            value="{{ old('phone') ?? $user->phone }}"
            pattern="[0-9]{3} [0-9]{3} [0-9]{3}"
            placeholder="123 456 789"
          >
        
          <input
            id="phone_show"
            type="checkbox"
            name="phone_show"
            {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
            value="0"
            hidden
          >
        
          <label class="input-button" for="phone_show">
            <svg xmlns="http://www.w3.org/2000/svg" class="checked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        
            <svg xmlns="http://www.w3.org/2000/svg" class="unchecked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
          </label>
        </div>
      </div>
    
      <div class="flex items-center w-full">
        <label for="skype" class="w-20 mr-2 inline-block font-semibold">{{ __('profile.skype') }}</label>
      
        <div class="flex w-full">
          <input
            id="skype"
            type="text"
            class="input w-full @error('skype') error @enderror"
            name="skype"
            value="{{ old('skype') ?? $user->skype }}"
            maxlength="32"
          >
        
          <input
            id="skype_show"
            type="checkbox"
            name="skype_show"
            {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
            value="0"
            hidden
          >
        
          <label class="input-button" for="skype_show">
            <svg xmlns="http://www.w3.org/2000/svg" class="checked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        
            <svg xmlns="http://www.w3.org/2000/svg" class="unchecked-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
          </label>
        </div>
      </div>
    
      <button type="submit" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 font-semibold rounded-full">
        {{ __('create.save') }}
      </button>
    </div>
  </form>
</div>
@endsection
