<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ env('APP_NAME') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

    <script defer>
        var previousScrollPosition = window.pageYOffset;

        window.addEventListener('scroll', function (event) {
            const brandElement = document.getElementById('brand');
            const topbarElement = document.getElementById('topbar');

            const initialClasses = ['navbar-dark', 'bg-transparent'];
            const classesAfterScrolling = ['navbar-light', 'bg-white', 'shadow'];

            const currentScrollPosition = window.pageYOffset;

            if (window.scrollY > (window.innerHeight / 3)) {
                // after scrolling title section
                brandElement.style = 'opacity: 1;';

                topbarElement.classList.remove(...initialClasses);
                topbarElement.classList.add(...classesAfterScrolling);
            } else {
                // before scrolling title section
                brandElement.style = 'opacity: 0;';

                topbarElement.classList.remove(...classesAfterScrolling);
                topbarElement.classList.add(...initialClasses);
            }
        });

        new WOW().init();
        AOS.init();
    </script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

    <style>
      @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap&subset=latin-ext');
      @import url('https://fonts.googleapis.com/css?family=Walter+Turncoat');

      html {
        scroll-behavior: smooth;

        --color: #263238;
        --background-color: #fff;
      }

      body {
        margin: 0 !important;
        padding: 0 !important;

        color: var(--color);
        background-color: var(--background-color);

        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
      }

      @media (max-width: 767px) {
        body {
          font-size: 18px;
        }
      }

      .noselect {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently supported by Chrome and Opera */
      }

      #topbar {
        top: 0;
        
        transition: 0.3s;
      }

      #brand {
        transition: opacity 0.3s;
      }

      #title {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('./img/background.jpg');
        background-color: beige;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
      }

      #title h1{
        font-size: 3em;
      }

      #howdoesitwork {
        background: url('./img/blackboard.jpeg');
      }

      .chalk {
        font-family: "Walter Turncoat", cursive;
        font-weight: bold;
      }
    </style>
  </head>

  <body>
      <nav id="topbar" class="w-100 h-20 position-fixed navbar navbar-expand-lg navbar-dark noselect">
          <h1 id="brand" class="chalk" style="opacity: 0;">{{ env('APP_NAME') }}</h1>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a href="#whatitis" class="nav-link">Co to?</a>
                  </li>
                  <li class="nav-item active">
                      <a href="#howdoesitwork" class="nav-link">Jak to działa?</a>
                  </li>
                  <li class="nav-item active">
                      <a href="#whyworth" class="nav-link">Dlaczego warto?</a>
                  </li>
                  @if (Route::has('login'))
                      @auth
                          <li class="nav-item active">
                              <a href="{{ url('/home') }}" class="nav-link">Pulpit</a>
                          </li>
                      @else
                          <li class="nav-item active">
                              <a href="{{ route('login') }}" class="nav-link">Zaloguj się</a>
                          </li>

                          @if (Route::has('register'))
                              <li class="nav-item active">
                                  <a href="{{ route('register') }}" class="nav-link">Zarejestruj się</a>
                              </li>
                          @endif
                      @endauth
                  @endif
              </ul>
          </div>
      </nav>

      <main>
          <header id="title" class="vh-100 mb-auto d-flex flex-column text-white">
              <div class="align-self-center text-center mt-auto mb-auto">
                  <h1 class="chalk animate__animated animate__fast animate__fadeInDown">{{ env('APP_NAME') }}</h1>
                  <h4 class="mt-3 animate__animated animate__fast animate__fadeInUp">Trafne rozwiązania dla trafnych pytań</h4>
              </div>

              <h6 class="m-2">Autor zdjęcia w tle: <strong>Lum3n</strong> z <strong>Pexels</strong></h6>
          </header>

          <section id="whatitis" class="p-5">
              <h1>Co to jest?</h1>


          </section>

          <section id="howdoesitwork" class="pt-5 d-flex flex-column text-white">
              <div class="text-center">
                  <h1 class="mb-5">Jak to działa?</h1>

                  <div class="mb-3">
                      <h2 class="chalk">1</h2>
                      <h5>Zaloguj się do <span class="chalk">{{ env('APP_NAME') }}</span></h5>
                  </div>

                  <div class="mb-3">
                      <h2 class="chalk">2</h2>
                      <h5>Kup wybrany pakiet dostępu.</h5>
                  </div>

                  <div class="mb-3">
                      <h2 class="chalk">3</h2>
                      <h5>Poszukaj swojego zadania w naszej bazie.</h5>
                  </div>

                  <div class="mb-3">
                      <h2 class="chalk">Nie ma?</h2>
                      <h5>Wyślij je do naszego zespołu!</h5>
                  </div>
              </div>

              <h6 class="m-2">Autor zdjęcia w tle: <strong>Dids</strong> z <strong>Pexels</strong></h6>
          </section>

          <section id="whyworth" class="p-5">
            <h1 class="pb-5">Dlaczego warto?</h1>

            <div class="row text-center justify-content-around">
              <div class="card col-md-3 mb-sm-3 p-3">
                <h3>Odpowiedzi od ekspertów</h3>

                <hr>

                <p>
                  
                </p>
              </div>

              <div class="card col-md-3 p-3">
                <h3>asdf</h3>
              </div>

              <div class="card col-md-3 p-3">
                <h3>asdf</h3>
              </div>
            </div>
          </section>
      </main>

      @component('components.layout.footer')
      @endcomponent
  </body>
</html>
