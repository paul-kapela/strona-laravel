<div class="mr-2 p-2 text-gray-700 dark:text-gray-300 lg:bg-gray-100 lg:dark:bg-gray-700 lg:rounded-full">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
  </svg>
</div>

<div>
  <h3>
    {{
      __('notification.email_change', [
        'newEmail' => $notification->data['newEmail']
      ])
    }}
  </h3>
  
  <h4 class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at }}</h4>
</div>