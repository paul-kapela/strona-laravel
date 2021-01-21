<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Obliczamy.pl</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//stackpath.bootstrapcdn.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @if(session()->get('theme') == 'dark')
        <link rel="stylesheet" href="/css/bootstrap.dark.min.css"/> 
    @else
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">
    @endif
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    @yield('styles')
</head>

<body class="d-flex flex-column">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark">
          <div class="container">
            <div class="navbar-brand">
              <h1 class="chalk">{{ config('app.name', 'Laravel') }}</h1>
            </div>
          </div>
        </nav>

        <main class="py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">{{ __('email_change.success') }}</div>

                    <div class="card-body">
                      <p>{{ __('email_change.success_message', ['newEmail' => request('newEmail')]) }}</p>

                      <a href="{{ route('home') }}" class="mt-4">
                        <h3>
                          {{ __('email_change.back_to_service') }}
                        </h3>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </main>
    </div>

    @component('components/layout/footer')    
    @endcomponent

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>
