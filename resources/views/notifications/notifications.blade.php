@if($notifications->first())
  @foreach($notifications as $notification)
    @component('components/notification', [
      'notification' => $notification,
      'tab' => $tab ?? ''
    ])
    @endcomponent
  @endforeach
@else
  <div class="{{ $tab ? 'mt-2 mb-3 text-dark' : 'mt-5 text-white' }} text-center justify-content-center">
    <h3>{{ __('notification.no').' '.__('notification.notifications') }}</h3>
  </div>
@endif