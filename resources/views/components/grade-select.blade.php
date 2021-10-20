<h1 class="text-2xl font-semibold">{{ __('grade.grades') }}</h1>

<hr class="my-3 dark:opacity-10 border-t-2">

<div class="py-2 flex lg:flex-col flex-row lg:space-x-0 space-x-3 lg:space-y-3 lg:overflow-auto overflow-x-scroll">
  @foreach(\App\Grade::all() as $grade)
    <a href="{{ route('assignments.index', array_merge(request()->all(), [ 'grade' => $grade->name ])) }}" class="flex items-center text-xl font-semibold {{ request('grade') == $grade->name ? 'text-gray-500' : '' }}">
      @switch($grade->name)
        @case('highschool')
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          @break
        @case('college')
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M12 14l9-5-9-5-9 5 9 5z" />
            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
          </svg>
          @break
        @default    
      @endswitch

      <h3>{{ __('grade.'.$grade->name) }}</h3>
    </a>
  @endforeach

  <a href="{{ route('assignments.index', array_filter(array_merge(request()->all(), [ 'grade' => '' ]))) }}" class="flex items-center text-xl font-semibold {{ !request('grade') ? 'text-gray-500' : '' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
    </svg>

    <h3>{{ __('subject.all') }}</h3>
  </a>
</div>