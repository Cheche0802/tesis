<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('meta-title', config('app.name') . ' | Blog')</title>
    <meta name="description" content="@yield('meta-description', 'Este es el blog de Zendero')">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/framework.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/adminlte/carouselBootstrap/css/bootstrap.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{{ asset('/adminlte/carouselBootstrap/js/bootstrap.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    @yield('styles')
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="preload"></div>
    <header class="space-inter">
        <div class="container container-flex space-between">
            <div class="logo">
                <a href="/">
                    <img src="/img/logo CDG.png" alt="">
                </a>
            </div>
            @include('partials.nav')
        </div>
    </header>

    <!-- Contenido -->
    @yield('content')

    <section class="footer fixed-bottom">
        <footer id="footerL">
            <div class="container contents">
                <div class="column">
                    <figure class="logo">
                        {{-- <a href="/">
                            <img src="/img/logo CDG.png" alt="">
                        </a> --}}
                    </figure>
                </div>
                <div class="column">
                    <p class="info strong">Direccion</p>
                    <p class="info">C. Boyaca, Los Teques 1201 Miranda </p>
                </div>
                <div class="column">
                    <p class="info strong">Telefono</p>
                    <p class="info">+58 412-5568963</p>
                    <p class="info">+58 416-7251012</p>
                </div>
                <div class="column">
                    <p class="info strong">Email</p>
                    <p class="info">principal@comunidaddegracia.com</p>
                    <p class="info">contacto@comunidaddegracia.com</p>
                </div>
            </div>

            {{-- <nav>
                <ul class="container-flex space-center list-unstyled" style="color:black!important">
                    <li><a href="#" class="c-gris-2 text-uppercase active">home</a></li>
                    <li><a href="#" class="c-gris-2 text-uppercase">about</a></li>
                    <li><a href="#" class="c-gris-2 text-uppercase">archive</a></li>
                    <li><a href="#" class="c-gris-2 text-uppercase">contact</a></li>
                </ul>
            </nav> --}}

            {{--       <div class="divider-2"></div>
            <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
            <div class="divider-2" style="width:80%;"></div>
            <p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
            <ul class="social-media-footer list-unstyled">
                <li><a href="#" class="fb"></a></li>
                <li><a href="#" class="tw"></a></li>
                <li><a href="#" class="in"></a></li>
                <li><a href="#" class="pn"></a></li>
            </ul>
        </div>
        --}}

    </footer>
    {{-- <img src="{{ asset('/img/formato Nº3.2.3-02.jpg') }}" style="width: 100%; height: 100%; padding: 0px; margin: 0px"> --}}
    </section>



    <script>
        (function(window, document) {
            var menu = document.getElementById('menu'),
                WINDOW_CHANGE_EVENT = ('onorientationchange' in window) ? 'orientationchange' : 'resize';

            function toggleHorizontal() {
                [].forEach.call(
                    document.getElementById('menu').querySelectorAll('.custom-can-transform'),
                    function(el) {
                        el.classList.toggle('pure-menu-horizontal');
                    }
                );
            };

            function toggleMenu() {
                // set timeout so that the panel has a chance to roll up
                // before the menu switches states
                if (menu.classList.contains('open')) {
                    setTimeout(toggleHorizontal, 500);
                } else {
                    toggleHorizontal();
                }
                menu.classList.toggle('open');
                document.getElementById('toggle').classList.toggle('x');
            };

            function closeMenu() {
                if (menu.classList.contains('open')) {
                    toggleMenu();
                }
            }

            document.getElementById('toggle').addEventListener('click', function(e) {
                toggleMenu();
                e.preventDefault();
            });

            window.addEventListener(WINDOW_CHANGE_EVENT, closeMenu);
        })(this, this.document);
    </script>
    @yield('scripts')

</body>

</html>
