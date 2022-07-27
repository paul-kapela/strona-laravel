<h1 class="text-2xl font-semibold">{{ __('subject.subjects') }}</h1>

<hr class="my-3 dark:opacity-10 border-t-2">

<div class="py-2 flex lg:flex-col flex-row lg:space-x-0 space-x-3 lg:space-y-3 lg:overflow-auto overflow-x-scroll">
  @foreach(\App\Subject::all() as $subject)
    <a href="{{ route($route_base.'.index', array_merge(request()->all(), [ 'subject' => $subject->name ])) }}" class="flex items-center text-xl font-semibold {{ request('subject') == $subject->name ? 'text-gray-500' : '' }}">
      @switch($subject->name)
        @case('physics')
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
          </svg>
          @break
        @case('mathematics')
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
          </svg>        
          @break
        @default
          @break
      @endswitch
      

      <h3>{{ __('subject.'.$subject->name) }}</h3>
    </a>
  @endforeach

  <a href="{{ route($route_base.'.index', array_filter(array_merge(request()->all(), [ 'subject' => '' ]))) }}" class="flex items-center text-xl font-semibold {{ !request('subject') && Request::url() != route('home') ? 'text-gray-500' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
    </svg>

    <h3>{{ __('subject.all') }}</h3>
  </a>
</div>