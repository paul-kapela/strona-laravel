@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-baseline">
          <span class="mr-auto">{{ __('actions.delete').' '.__('request.request') }}</span>

          @component('components.close-button', [
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

          <form method="POST" action="{{ route('requests.destroy', $request) }}">
            @csrf
            @method('DELETE')

            <label for="delete-confirm">{{ __('actions.delete_confirmation').__('request.request').'?' }}</label>

            <div class="form-group row mb-0">
              <div class="col-md-6">
                <button id="delete-confirm" type="submit" class="btn btn-danger">
                  {{ __('actions.delete') }}
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