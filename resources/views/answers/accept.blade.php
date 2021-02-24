@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <span class="mr-auto">{{ __('actions.approve').' '.lcfirst(__('content.answer')) }}</span>

          @component('components.close-button', [
            'back' => true
          ])  
          @endcomponent
        </div>

        <div class="card-body">
          @component('components.assignment', [
            'assignment' => $answer->assignment,
            'multilang' => true
          ])  
          @endcomponent

          <hr>

          @component('components.answer', [
            'answer' => $answer,
            'withoutActions' => true,
            'multilang' => true
          ])  
          @endcomponent

          <form method="POST" action="{{ route('answers.accept', $answer) }}" enctype="multipart/form-data" id="accept-form">
            @csrf

            <div class="form-group row">
              <label for="points" class="col-md-4 col-form-label">{{ __('content.points') }}: </label>
  
              <div class="col-md-6 d-flex">
                <input
                  id="points"
                  type="number"
                  min="0"
                  step="1"
                  class="form-control{{ $errors->has('points') ? 'is-invalid' : '' }}"
                  name="points"
                  value="{{ old('points') }}"
                >
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6">
                <button class="btn btn-primary" type="submit">
                  {{ __('request.accept') }}
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