<div>
  <p class="mb-0">
    {{
      __('notification.request_responded', [
        'date' => \App\Request::findOrFail($notification->data['request_id'])->due_date
      ])
    }}
  </p>

  <hr>

  @component('components.request', [
    'request' => \App\Request::findOrFail($notification->data['request_id'])
  ])  
  @endcomponent
</div>