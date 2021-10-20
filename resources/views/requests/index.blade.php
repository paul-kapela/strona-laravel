@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('request.title') }}</h1>

    @if(request('assignment'))
      @component('components/close-button', [
        'back' => true,
        'white' => true
      ])
      @endcomponent
    @endif
  </div>
    
  @component('components.requests', [
    'requests' => $requests
  ])
  @endcomponent
</div>
@endsection