<nav class="navbar navbar-expand-md navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <h1 class="chalk">{{ config('app.name', 'Laravel') }}</h1>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
      
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
          </li>
        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.signup') }}</a>
          </li>
        @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->username }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if(Auth::user()->belongsToRoles('editor', 'admin'))
                  <a class="dropdown-item" href="{{ route('answers.index') }}">{{ __('content.all').' '.__('profile.answers') }}</a>
                @endif
                
                @if(policy(\App\Answer::class)->create(Auth::user()))
                  <a class="dropdown-item" href="{{ route('answers.index', [ 'user' => Auth::user()->id ]) }}">{{ __('profile.my').' '.__('profile.answers') }}</a>
                @endif

                <a class="dropdown-item" href="{{ route('assignments.index', [ 'user' => Auth::user()->id ]) }}">{{ __('profile.my').' '.__('profile.assignments') }}</a>

                @if(Auth::user()->belongsToRoles('user'))
                  <a class="dropdown-item" href="{{ route('requests.index') }}">{{ __('profile.my').' '.lcfirst(__('request.title')) }}</a>

                  <a class="dropdown-item" href="{{ route('plans.index') }}">{{ __('plan.my').' '.__('plan.plan') }}</a>
                @else
                  <a class="dropdown-item" href="{{ route('requests.index') }}">{{ __('content.all').' '.lcfirst(__('request.title')) }}</a>
                @endif

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">{{ __('profile.profile') }}</a>                          

                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('auth.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>

            @component('components/layout/topbar/notifications', [
              'notifications' => Auth::user()->notifications()->latest()->take(3)->get()
            ])
            @endcomponent
          @endguest

          @component('components/layout/topbar/theme-switch')
          @endcomponent

          @component('components/layout/topbar/language-dropdown')
          @endcomponent
      </ul>
    </div>
  </div>
</nav>