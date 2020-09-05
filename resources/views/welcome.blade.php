<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Obliczamy.pl - *jakieś hasło*</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" defer></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

        <script defer>
        window.addEventListener('scroll', function (event) {
            const topbarElement = document.getElementById('topbar');

            if (window.scrollY > (window.innerHeight / 3)) {
                topbarElement.classList.remove('navbar-dark');
                topbarElement.classList.remove('bg-transparent');
                topbarElement.classList.add('navbar-light');
                topbarElement.classList.add('bg-white');
            } else {
                topbarElement.classList.remove('navbar-light');
                topbarElement.classList.remove('bg-white');
                topbarElement.classList.add('navbar-dark');
                topbarElement.classList.add('bg-transparent');
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
                font-size: 24px;
            }

            @media (max-width: 767px) {
                body {
                    font-size: 18px;
                }
            }

            header, section, footer {
                display: block;
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
                width: 100%;
                position: fixed;
                top: 0;
                z-index: 1;

                will-change: background-color, color;
                transition: 0.3s;
            }

            #title {
                background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('./img/background.jpg');
                background-color: beige;
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
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
        <nav id="topbar" class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">
                <h1 class="chalk">Obliczamy.pl</h1>
            </a>
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
                        <a href="" class="nav-link">Dlaczego warto?</a>
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
                    <h1 class="animate__animated animate__fast animate__fadeInDown">Hello there</h1>
                    <p class="animate__animated animate__fast animate__fadeInUp">More text there</p>
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
                        <h5>Zaloguj się do <span class="chalk">odrabiamy.pl</span></h5>
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
        </main>
    </body>
</html>
