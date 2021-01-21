@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-white mb-4">{{ __('notification.title') }}</h1>

  <div class="row justify-content-center">  
    <div class="col-md-8">
      @component('notifications/notifications', [
        'notifications' => $notifications
      ])  
      @endcomponent
    </div>

    <div class="col-md-4 card card-body">
      
    </div>
  </div>
</div>
@endsection