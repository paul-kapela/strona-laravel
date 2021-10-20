<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ env('APP_NAME') }}</title>
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//stackpath.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css" integrity="sha384-AfEj0r4/OFrOo5t7NnNe46zW/tFgW6x/bCJG8FqQCEo3+Aro6EYUG4+cU+KJWu/X" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    @yield('styles')
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  
  <body class="text-gray-800 dark:text-gray-200 dark:bg-gray-800">
    <div id="app" class="min-h-screen">
      @component('components/layout/topbar')
      @endcomponent
      
      <main class="lg:px-20 px-10 lg:py-10 py-5 lg:grid lg:grid-cols-12">
        @yield('content')
      </main>
    </div>

    @component('components/layout/footer')    
    @endcomponent

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js" integrity="sha384-g7c+Jr9ZivxKLnZTDUhnkOnsh30B4H0rpLUpJ4jAIKs4fnJI+sEnkvrMWph2EDg4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js" integrity="sha384-mll67QQFJfxn0IYznZYonOWZ644AWYC+Pt2cHqMaRhXVrursRwvLnLaebdGIlYNa" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    @yield('scripts')

    <script>
      function dropdownClick(event, name) {
        event.preventDefault();

        document.querySelectorAll("[id$='DropdownContent']:not(#"+ name +"DropdownContent)").forEach(dropdownContent => dropdownContent.classList.add("hidden"));
        document.getElementById(name + "DropdownContent").classList.toggle("hidden");
      }

      function menuButtonClick(event) {
        event.preventDefault();

        openMobileMenu();
      }

      function openMobileMenu() {
        let menu = document.getElementById("menu");
        let navigation = document.getElementById("navigation");

        menu.classList.toggle("hidden");
        menu.classList.toggle("flex");

        navigation.classList.toggle("absolute");  
        navigation.classList.toggle("z-20");
      }

      function closeMobileMenu() {

      }

      window.onmouseup = function (event) {
        if (!event.target.closest("[id$=DropdownButton]") && !event.target.closest("[id$='DropdownContent']")) {
          document.querySelectorAll("[id$='DropdownContent']").forEach(dropdownContent => dropdownContent.classList.add("hidden"));
        }
      }

      switch (localStorage.getItem('theme')) {
        case 'dark':
          document.querySelector('html').classList.add('dark');
          break;
        case 'light': default:
          document.querySelector('html').classList.remove('dark');
          break;
      }
    </script>
  </body>
</html>
