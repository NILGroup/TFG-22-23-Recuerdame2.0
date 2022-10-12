@guest


<!-- Navbar en el login, para usuarios no registrados -->

@else
<!-- Navbar  para usuarios registrados -->
@if(Session::has('paciente'))
<!-- Aunque esté registrado solo tendrá navbar si hay un paciente seleccionado -->

@if (Auth::user()->rol_id == 1)
<!-- Navbar para terapeutas -->
<nav class="navbar navbar-expand-lg justify-content-left nav-menu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-left" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link letra-primary-color menu" aria-current="page" href="/listadoSesiones.php">Sesiones</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Evaluaciones</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="listadoInformesSesion.php">Informes de las sesiones</a></li>
                        <li><a class="dropdown-item" href="listadoInformesSeguimiento.php">Informes de seguimiento</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Historias de Vida</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="historiaVida.php">Ver Historia de Vida</a></li>
                        <li><a class="dropdown-item" href="/recuerdos/{{Session::get('paciente')['id']}}">Ver recuerdos</a></li>
                        <li><a class="dropdown-item" href="/paciente/{{Session::get('paciente')['id']}}/personas">Personas relacionadas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link letra-primary-color menu" href="/paciente/{{Session::get('paciente')['id']}}/calendario">Calendario</a>
                </li>
            </ul>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if( Session::get('paciente')['genero'] == 'H')
                <img src="/img/avatar_hombre.png" alt="Avatar" class="avatar-mini">
                @elseif( Session::get('paciente')['genero'] == 'M')
                <img src="/img/avatar_mujer.png" alt="Avatar" class="avatar-mini">
                @endif

            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                {{ Session::get('paciente')['nombre'] }}
            </div>
        </div>

        <div class="row align-items-center pe-4">
            <div class="col-12">
                {{ Session::get('paciente')['genero'] }}
            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">{{Carbon\Carbon::parse(Session::get('paciente')['fecha_nacimiento'])->age}}
            </div>
        </div>
    </div>
</nav>
@else
<!-- Navbar para cuidadores -->

<nav class="navbar navbar-expand-lg justify-content-left nav-menu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-left" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link letra-primary-color menu" aria-current="page" href="pacientes/{{ Session::get('paciente')['id'] }}">Paciente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link letra-primary-color menu" href="/calendario">Calendario</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Historia de Vida</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="historiaVida.php">Ver Historia de Vida</a></li>
                        <li><a class="dropdown-item" href="/recuerdos/{{Session::get('paciente')['id']}}">Ver recuerdos</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if( Session::get('paciente')['genero'] == 'H')
                <img src="/img/avatar_hombre.png" alt="Avatar" class="avatar-mini">
                @elseif( Session::get('paciente')['genero'] == 'M')
                <img src="/img/avatar_mujer.png" alt="Avatar" class="avatar-mini">
                @endif

            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                {{ Session::get('paciente')['nombre'] }}
            </div>
        </div>

        <div class="row align-items-center pe-4">
            <div class="col-12">
                {{ Session::get('paciente')['genero'] }}
            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">{{Carbon\Carbon::parse(Session::get('paciente')['fecha_nacimiento'])->age}}
            </div>
        </div>
    </div>
</nav>

@endif
<!-- Arriba el termina el IF de si es cuidador, y Abajo el de si tiene un paciente seleccionado -->
@endif


@endguest
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
