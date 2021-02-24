@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('profile.profile') }}</div>

        <div class="card-body">
          <div class="d-flex flex-row align-items-center">
            <img src="{{ $user->profileImage() }}" class="rounded-circle mr-3" style="width: 5em;">

            <div class="d-flex flex-row align-items-center">
              <h3 class="mr-3">{{ $user->username }}</h3>

              @can('update', $user)
                <a href="{{ route('users.edit', $user) }}" class="mr-2">{{ __('profile.edit') }}</a>

                <a href="{{ route('password.change') }}">{{ __('passwords.change_password') }}</a>
              @endcan
            </div>
          </div>

          <hr>

          <div class="d-flex flex-row align-items-center text-center justify-content-center">
            <div class="col-md-4">
              <h5>{{ $user->created_at ?? 'N/A' }}</h5>
              <h6>{{ __('profile.joined') }}</h6>
            </div>

            <div class="col-md-4">
              <h5>{{ $user->assignments()->count() }}</h5>
              <h6>{{ __('profile.added').' '.__('profile.assignments') }}</h6>
            </div>

            <div class="col-md-4">
              @if(policy(\App\Answer::class)->create($user))
                <h5>{{ $user->answers()->count() }}</h5>
                <h6>{{ __('profile.added').' '.__('profile.answers') }}</h6>
              @endif
            </div>
          </div>

          <hr>

          <div class="d-flex flex-row align-items-center text-center justify-content-center">
            <div class="col-md-4">
              <h5>
                @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->email_show)
                  {{ $user->email ?? 'N/A' }}
                @else
                  {{ __('profile.hidden') }}
                @endif
              </h5>
              
              <h6>{{ __('profile.email') }}</h6>
            </div>

            <div class="col-md-4">
              <h5>
                @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->phone_show)
                  {{ $user->phone ?? 'N/A' }}
                @else
                  {{ __('profile.hidden') }}
                @endif
              </h5>

              <h6>{{ __('profile.phone') }}</h6>
            </div>

            <div class="col-md-4">
              <h5>
                @if(policy(\App\User::class)->view(Auth::user(), $user) || $user->skype_show)
                  {{ $user->skype ?? 'N/A' }}
                @else
                  {{ __('profile.hidden') }}
                @endif
              </h5>

              <h6>{{ __('profile.skype') }}</h6>
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
      </div>
    </div>
  </div>
</div>
@endsection
