<nav class="navbar navbar-expand-md navbar-light shadow-sm bg-info">
    <div class="container-fluid">
        <div class="bg-image hover-zoom"><a class="navbar-brand " href="{{ url('/') }}"><img class="logotipoMarca w-100" src="/img/Marca_recuerdame.png" /></a></div>

        <div class="d-flex flex-row-reverse">

            <div id="">
                @guest
                @if (Route::has('login'))
                <li class="nav-item btn">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item btn">
                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Registro') }}</a>
                </li>
                @endif
                @else
                <ul class="navbar-nav d-flex flex-row">
                    @if (Auth::user()->rol_id == 1)
                    <li class="nav-item" style="margin-right: 10px;">
                        <div >
                            <a class="nav-link p-2" href="{{ route('pacientes.index') }}"><i class="fa-solid fa-users"></i></a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item align-items-center">
                        <div class="col-12">
                            <div data-letters="{{ Auth::user()->nombre[0] }}{{ Auth::user()->apellidos[0] }}"></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown btn btn-danger">


                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            <b style="font-weight: normal;" class="largeScreen">Cerrar sesión </b>
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
    </div>
</nav>