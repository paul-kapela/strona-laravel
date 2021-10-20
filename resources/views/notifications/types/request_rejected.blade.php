<div class="mr-2 p-2 text-gray-700 dark:text-gray-300 lg:bg-gray-100 lg:dark:bg-gray-700 lg:rounded-full">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
  </svg>
</div>

<div>
  <h3>
    {{
      __('notification.request_rejected', [
        'date' => $notification->data['due_date']
      ])
    }}
  </h3>

  @component('components/assignment', [
    'assignment' => \App\Assignment::findOrFail($notification->data['assignment_id'])
  ])
  @endcomponent
  
  <h4 class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at }}</h4>
</div>