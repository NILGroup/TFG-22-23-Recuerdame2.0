<nav class="navbar navbar-expand-md navbar-light shadow-sm yellowbg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"><img class="logotipoMarca" src="/img/Marca_recuerdame.png" /></a>

    
    <div class ="d-flex flex-row-reverse">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @guest
            @if (Route::has('login'))
                <li class="nav-item btn">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item btn">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                </li>
            @endif
            @else
                <ul class="navbar-nav">
                    @if (Auth::user()->rol_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pacientes.index') }}"><i class="fa-solid fa-users"></i></a>
                        </li>
                    @endif
                    <li class="nav-item align-items-center">
                        <div class="col-12">
                            <div data-letters="{{ Auth::user()->nombre[0] }}{{ Auth::user()->apellidos[0] }}"></div> 
                        </div>
                    </li>
                    <li class="nav-item dropdown btn btn-outline-danger">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Cerrar sesión
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                {{csrf_field()}}
                            </form>
                        </div>
                    </li>
                        
                </ul>
        @endguest
        </div>
    </div>
</nav>
