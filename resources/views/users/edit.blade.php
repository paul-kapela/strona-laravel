@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <span class="mr-auto">{{ __('profile.edit').' '.lcfirst(__('profile.profile')) }}</span>

          @component('components.close-button', [
            'back' => true
          ])
          @endcomponent
        </div>

        <div class="card-body">
          <form action="{{ route('users.update', $user) }}" entype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="d-flex align-items-center">
              <img src="{{ $user->profileImage() }}" class="rounded-circle mr-3" style="width: 5em;">
  
              <div class="d-flex flex-row align-items-center">
                <input
                  type="text"
                  class="w-75 mr-3 form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                  name="username"
                  value={{ old('username') ?? $user->username }}
                  maxlength="30"
                  autofocus
                >
              </div>
            </div>
  
            <hr>
  
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label">{{ __('profile.email')}}: </label>

              <div class="col-md-6">
                <div class="d-flex">
                  <input
                    id="email"
                    type="text"
                    class="mr-3 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email"
                    value="{{ old('email') ?? $user->email }}"
                    maxlength="50"
                    placeholder="email@example.com"
                    required
                  >

                  <div class="d-flex align-items-center">
                    <input
                      id="email_show"
                      type="checkbox"
                      class="mr-2"
                      name="email_show"
                      {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
                      value="0"
                    >

                    <label for="email_show" class="mt-2">{{ __('profile.view') }}</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="phone" class="col-md-4 col-form-label">{{ __('profile.phone') }}: </label>

              <div class="col-md-6">
                <div class="d-flex">
                  <input
                    id="phone"
                    type="tel"
                    class="mr-3 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="phone"
                    value="{{ old('phone') ?? $user->phone }}"
                    pattern="[0-9]{3} [0-9]{3} [0-9]{3}"
                    placeholder="123 456 789"
                  >

                  <div class="d-flex align-items-center">
                    <input
                      id="phone_show"
                      type="checkbox"
                      class="mr-2"
                      name="phone_show"
                      {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
                      value="0"
                    >

                    <label for="phone_show" class="mt-2">{{ __('profile.view') }}</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="skype" class="col-md-4 col-form-label">{{ __('profile.skype') }}: </label>

              <div class="col-md-6">
                <div class="d-flex">
                  <input
                    id="skype"
                    type="text"
                    class="mr-3 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="skype"
                    value="{{ old('skype') ?? $user->skype }}"
                    maxlength="32"
                  >

                  <div class="d-flex align-items-center">
                    <input
                      id="skype_show"
                      type="checkbox"
                      class="mr-2"
                      name="skype_show"
                      {{ old('skype_show') || $user->skype_show ? 'checked' : '' }}
                      value="0"
                    >

                    <label for="skype_show" class="mt-2">{{ __('profile.view') }}</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button class="btn btn-primary" type="submit">
                  {{ __('create.save') }}
                </button>
              </div>
            </div>
          </form>

          @if ($errors->any())
            <div class="alert alert-danger mt-3">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
