@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <span class="mr-auto">{{ __('request.answer').' '.__('request.request') }}</span>
          
          @component('components/close-button', [
            'back' => true
          ])
          @endcomponent
        </div>

        <div class="card-body">
          @component('components.request', [
            'request' => $request
          ])
          @endcomponent

          <hr>

          <form method="POST" action="{{ route('requests.answer', $request) }}" enctype="multipart/form-data" id="accept-form">
            @csrf

            <div class="form-group row">
              <label for="price" class="col-md-4 col-form-label">{{ __('content.price') }}: </label>

              <div class="col-md-6">
                <input
                  id="price"
                  type="number"
                  min="0"
                  step="0.01"
                  class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                  name="price"
                  value="{{ old('price') }}"
                >
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">
                  {{ __('create.send') }}
                </button>
              </div>
            </div>
          </form>

          @if($errors->any())
            <div class="alert alert-danger mt-3">
              <ul>
                @foreach($errors->all() as $error)
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