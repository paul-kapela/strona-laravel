@if(!Request::is('notifications'))
  <div id="notificationsDropdown" class="relative">
    <a id="notificationsDropdownButton" onclick="dropdownClick(event, 'notifications')" href="#" class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
      </svg>

      <h3 class="ml-2 lg:hidden font-semibold leading-9">{{ __('notification.title') }}</h3>
    </a>

    <div id="notificationsDropdownContent" class="lg:absolute lg:right-0.5 lg:z-10 lg:mt-3 lg:my-0 my-3 lg:p-4 flex-col bg-white dark:bg-gray-800 lg:shadow-md lg:rounded-lg hidden">
      <h3 class="pr-40 mb-2 lg:block hidden font-semibold tracking-wide">{{ __('notification.title') }}</h3>

      @component('notifications/notifications', [
        'notifications' => $notifications,
        'tab' => true
      ])
      @endcomponent

      <a href="{{ route('notifications') }}" class="w-full p-2 mt-2 flex text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full">
        <h3 class="mx-2">{{ __('notification.show_all') }}</h3>

        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-auto mr-2 pt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
        </svg>
      </a>
    </div>
  </div>
@endif