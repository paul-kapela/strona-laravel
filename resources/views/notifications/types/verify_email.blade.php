<div class="mr-2 p-2 text-gray-700 dark:text-gray-300 lg:bg-gray-100 lg:dark:bg-gray-700 lg:rounded-full">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
  </svg>
</div>

<div>
  <h3>{{ __('notification.verify') }}</h3>

  <form id="resend-form" class="inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <a href="{{ route('verification.resend') }}" class="hover:underline" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">{{ __('notification.resend_verify_link') }}</a>
  </form>

  <h4 class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at }}</h4>
</div>