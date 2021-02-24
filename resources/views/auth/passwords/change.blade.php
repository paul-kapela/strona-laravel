@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <div class="mr-auto">{{ __('passwords.change_password') }}</div>

          @component('components.close-button', [
            'back' => true
          ])  
          @endcomponent
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('password.new') }}">
            @csrf

            <div class="form-group row">
              <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('passwords.current_password') }}</label>

              <div class="col-md-6">
                <input
                  id="current_password"
                  type="password"
                  class="form-control @error('current_password') is-invalid @enderror"
                  name="current_password"
                  required
                >
              </div>
            </div>

            <div class="form-group row">
              <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('passwords.new_password') }}</label>

              <div class="col-md-6">
                <input
                  id="new_password"
                  type="password"
                  class="form-control @error('new_password') is-invalid @enderror"
                  name="new_password"
                  required
                >
              </div>
            </div>

            <div class="form-group row">
              <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('passwords.confirm_password') }}</label>

              <div class="col-md-6">
                <input
                  id="new_password_confirmation"
                  type="password"
                  class="form-control @error('new_password_confirmation') is-invalid @enderror"
                  name="new_password_confirmation"
                  required
                >
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('passwords.change') }}
                </button>
              </div>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger mt-3">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection