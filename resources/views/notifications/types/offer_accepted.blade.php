<div>
  <p class="mb-0">{{ __('notification.offer_accepted') }}</p>

  <hr>

  @component('components/request', [
    'request' => \App\Request::findOrFail($notification->data['request_id'])
  ])  
  @endcomponent
</div>