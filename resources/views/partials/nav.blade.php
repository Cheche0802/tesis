<nav class="custom-wrapper" id="menu">
    <div class="pure-menu">
        <a href="#" class="custom-toggle btn-bar" id="toggle"></a>
    </div>
    <ul class="container-flex list-unstyled">
        <li class="pure-menu-item">
            <a href="{{ route('pages.home') }}"
                class="pure-menu-link c-gris-2 text-uppercase {{ request()->routeIs('pages.home') ? 'hover' : '' }}">
                Inicio
            </a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('pages.about') }}"
                class="pure-menu-link c-gris-2 text-uppercase {{ request()->routeIs('pages.about') ? 'hover' : '' }}">
                Nosotros
            </a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('pages.archive') }}"
                class="pure-menu-link c-gris-2 text-uppercase {{ request()->routeIs('pages.archive') ? 'hover' : '' }}">
                Archivo
            </a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('pages.contact') }}"
                class="pure-menu-link c-gris-2 text-uppercase {{ request()->routeIs('pages.contact') ? 'hover' : '' }}">
                Contacto
            </a>
        </li>
    </ul>
</nav>
