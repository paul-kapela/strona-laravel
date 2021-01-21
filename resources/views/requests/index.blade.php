@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex">
    <h1 class="text-white mb-4 mr-4">{{ __('request.title') }}</h1>

    @if(request('assignment'))
      <h4>
        @component('components.close-button', [
          'back' => true,
          'white' => true
        ])
        @endcomponent
      </h4>
    @endif
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      @component('components.requests', [
        'requests' => $requests
      ])
      @endcomponent
    </div>

    <div class="col-md-4 card card-body">

    </div>
  </div>
</div>
@endsection