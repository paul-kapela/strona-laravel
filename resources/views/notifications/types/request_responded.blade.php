<div class="mr-2 p-2 text-gray-700 dark:text-gray-300 lg:bg-gray-100 lg:dark:bg-gray-700 lg:rounded-full">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
  </svg>
</div>

<div>
  <h3>
    {{
      __('notification.request_responded', [
        'date' => \App\Request::findOrFail($notification->data['request_id'])->due_date
      ])
    }}
  </h3>

  @component('components.request', [
    'request' => \App\Request::findOrFail($notification->data['request_id'])
  ])  
  @endcomponent

  <h4 class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at }}</h4>
</div>