<nav id="navigation" class="w-full lg:h-auto lg:relative px-6 py-4 flex flex-wrap lg:flex-row flex-col align-start bg-white dark:bg-gray-800 shadow-md select-none">
  <div class="flex w-100">
    <a href="{{ route('home') }}">
      <h1 class="text-4xl chalk">{{ config('app.name', 'Laravel') }}</h1>
    </a>

    <a href="#" onclick="menuButtonClick(event)" class="p-2 ml-auto lg:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </a>
  </div>
  
  <div id="menu" class="lg:ml-4 mr-0 lg:flex flex-grow flex-col lg:flex-row hidden">
    @guest
      <div class="lg:w-auto w-full ml-auto flex lg:flex-row flex-col align-start lg:space-x-3 lg:space-y-0 space-y-3">
        <a href="{{ route('login') }}" class="lg:mx-2 lg:mt-0 mt-5 flex">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full lg:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          
          <h3 class="lg:ml-0 ml-2 font-semibold leading-9">{{ __('auth.login') }}</h3>
        </a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="lg:mx-2 lg:mt-0 mt-5 flex">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full lg:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>

          <h3 class="lg:ml-0 ml-2 font-semibold leading-9">{{ __('auth.signup') }}</h3>
        </a>
        @endif
      </div>
    @else
      @component('components.search-bar', [
        'route_name' => 'assignments.index'
      ])
      @endcomponent

      <div class="ml-auto flex lg:w-auto w-full lg:flex-row flex-col align-start lg:space-x-3 lg:space-y-0 space-y-3">
        <a href="{{ route('assignments.create') }}" class="lg:mx-2 lg:mt-0 mt-5 flex">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full lg:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>

          <h3 class="lg:ml-0 ml-2 font-semibold leading-9">{{ __('create.send').' '.__('create.assignment')}}</h3>
        </a>

        @component('components/layout/topbar/notifications', [
          'notifications' => Auth::user()->notifications()->latest()->take(3)->get()
        ])
        @endcomponent

        <theme-switch :labels="{{ json_encode(Lang::get('theme')) }}"></theme-switch>

        @component('components/layout/topbar/language-dropdown')
        @endcomponent

        <div id="userDropdown" class="relative">
          <a id="userDropdownButton" href="#" onclick="dropdownClick(event, 'user')" class="flex lg:text-gray-700 lg:dark:text-gray-300 lg:bg-gray-100 lg:dark:bg-gray-700 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>

            <h3 class="lg:mx-0 mx-2 lg:font-normal font-semibold leading-9">{{ Auth::user()->username }}</h3>

            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 p-2 lg:block hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </a>

          <div id="userDropdownContent" class="lg:absolute lg:right-0.5 lg:z-10 lg:mt-3 lg:my-0 my-3 lg:p-4 flex-col bg-white dark:bg-gray-800 font-semibold lg:shadow-md lg:rounded-lg transition duration-500 ease-in-out hidden">
            @if(Auth::user()->belongsToRoles('editor', 'admin'))
              <a href="{{ route('assignments.index') }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>

                <h3 class="whitespace-nowrap">{{ __('content.all').' '.__('profile.assignments') }}</h3>
              </a>
            
              <a href="{{ route('answers.index') }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>

                <h3 class="whitespace-nowrap">{{ __('content.all').' '.__('profile.answers') }}</h3>
              </a>
              
              <a href="{{ route('requests.index') }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>

                <h3 class="whitespace-nowrap">{{ __('content.all').' '.lcfirst(__('request.title')) }}</h3>
              </a>
              
              <hr class="my-1 dark:opacity-10 border-t-2">
            @endif
            
            <a href="{{ route('assignments.index', [ 'user' => Auth::user()->id ]) }}" class="p-2 flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
              </svg>

              <h3 class="whitespace-nowrap">{{ __('profile.my').' '.__('profile.assignments') }}</h3>
            </a>

            @if(Auth::user()->belongsToRoles('user'))
              <a href="{{ route('requests.index') }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>

                <h3 class="whitespace-nowrap">{{ __('profile.my').' '.lcfirst(__('request.title')) }}</h3>
              </a>
            @endif

            @if(policy(\App\Answer::class)->create(Auth::user()))
              <a href="{{ route('answers.index', [ 'user' => Auth::user()->id ]) }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>

                <h3 class="whitespace-nowrap">{{ __('profile.my').' '.__('profile.answers') }}</h3>
              </a>
            @endif

            <hr class="my-1 dark:opacity-10 border-t-2">
            
            @if(Auth::user()->belongsToRoles('user'))
              <a href="{{ route('plans.index') }}" class="p-2 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                
                <h3 class="whitespace-nowrap">{{ __('plan.my').' '.__('plan.plan') }}</h3>
              </a>
            @endif

            <a href="{{ route('users.show', Auth::user()->id) }}" class="p-2 flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>

              <h3>{{ __('profile.profile') }}</h3>
            </a>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="p-2 flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>

              <h3>{{ __('auth.logout') }}</h3>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
              </form>
            </a>
          </div>
        </div>
      </div>
    @endguest
  </div>
</nav>