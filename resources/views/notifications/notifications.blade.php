@if($notifications->first())
  @foreach($notifications as $notification)
    @component('components/notification', [
      'notification' => $notification,
      'tab' => $tab ?? '' ?? ''
    ])
    @endcomponent
  @endforeach
@else
  <p class="p-3 pb-5 text-center">{{ __('notification.no').' '.__('notification.notifications') }}</p>
@endif