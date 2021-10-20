@extends('layouts.app')

@section('content')
<div class="col-span-12">
  <div class="flex mb-5">
    <h1 class="mr-auto text-2xl font-semibold">{{ __('notification.title') }}</h1>
    
    @component('components.close-button', [
      'back' => true
    ])
    @endcomponent
  </div>

  <div class="row justify-content-center">  
    @component('notifications/notifications', [
      'notifications' => $notifications
    ])  
    @endcomponent
  </div>

  {{ $notifications->appends(request()->all())->links() }}
</div>
@endsection