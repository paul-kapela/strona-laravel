@extends('layouts.app')

@section('content')
<div class="col-span-12 mb-5 flex">
  <h1 class="mr-auto text-2xl font-semibold">{{ __('profile.profile') }}</h1>

  @can('update', $user)
    <a href="{{ route('users.edit', $user) }}" class="mr-2 text-xl font-light">{{ __('profile.edit') }}</a>

    <a href="{{ route('password.change') }}" class="text-xl font-light">{{ __('passwords.change_password') }}</a>
  @endcan
</div>

<div class="col-span-3 p-5 rounded-border">
  <div class="flex items-center">
    <img src="{{ $user->profileImage() }}" class="w-20 mr-3 rounded-circle">

    <div class="px-2">
      <h3 class="font-semibold">{{ $user->username }}</h3>

      <h6>
        @foreach ($user->roles()->get() as $role)    
          {{ __('profile.'.$role->name) }} 
        @endforeach
      </h6>
    </div>
  </div>


  <div class="py-3 flex justify-between text-center">
    <div class="p-2">
      <h4 class="font-semibold">{{ $user->created_at ?? 'N/A' }}</h4>
      <h6 class="text-sm">{{ __('profile.joined') }}</h6>
    </div>

    <div class="p-2">
      <h4 class="font-semibold">{{ $user->assignments()->count() }}</h4>
      <h6 class="text-sm">{{ ucfirst(__('profile.assignments')) }}</h6>
    </div>

    <div class="p-2">
      @if(policy(\App\Answer::class)->create($user))
        <h4 class="font-semibold">{{ $user->answers()->count() }}</h4>
        <h6 class="text-sm">{{ ucfirst(__('profile.answers')) }}</h6>
      @endif
    </div>
  </div>

  <div class="flex flex-col space-y-2">
    <div class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
      </svg>

      <h4>
        @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->email_show)
          {{ $user->email ?? 'N/A' }}
        @else
          {{ __('profile.hidden') }}
        @endif
      </h4>
    </div>
  
    <div class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
      </svg>

      <h4>
        @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->phone_show)
          {{ $user->phone ?? 'N/A' }}
        @else
          {{ __('profile.hidden') }}
        @endif
      </h4>
    </div>
  
    <div class="flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
      </svg>
  
      <h4>
        @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->skype_show)
          {{ $user->skype.' ('.__('profile.skype').')' ?? 'N/A' }}
        @else
          {{ __('profile.hidden') }}
        @endif
      </h4>
    </div>
  </div>

  @if(Session::has('email_changed'))
    <div class="d-flex mt-2">
      <p class="mb-0 alert alert-success" role="alert">
        {{ __('email_change.changed', ['newEmail' => Session::get('email_changed')]) }}
      </p>
    </div>
  @endif

  @if(Session::has('password_changed'))
    <div class="d-flex mt-2">
      <p class="mb-0 alert alert-success" role="alert">
        {{ __('passwords.changed') }}
      </p>
    </div>
  @endif
</div>
@endsection
