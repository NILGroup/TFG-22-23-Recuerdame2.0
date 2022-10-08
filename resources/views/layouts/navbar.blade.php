
@guest
  

<!-- Navbar en el login, para usuarios no registrados -->

@else

<!-- Navbar en el login, para usuarios registrados -->
<nav class="navbar navbar-expand-lg justify-content-left nav-menu">
        @if (Auth::user()->rol_id == 1)
        <!-- Navbar para terapeutas -->
        <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-left" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link letra-primary-color menu" aria-current="page" href="listadoSesiones.php">Sesiones</a>
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
                    <li><a class="dropdown-item" href="historiaVida.php">Generar Historia de Vida</a></li>
                    <li><a class="dropdown-item" href="listadoRecuerdos.php">Recuerdos</a></li>
                    <li><a class="dropdown-item" href="listadoPersonasRelacionadas.php">Personas relacionadas</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link letra-primary-color menu" href="calendario.php">Calendario</a>
            </li>
        </ul>
    </div>

    <div class="row align-items-center pe-4">
        <div class="col-12">
            <!-- Si el paciente es hombre poner avatar de hombre, y si es mujer de mujer -->

        </div>
    </div>
    <div class="row align-items-center pe-4">
        <div class="col-12">
            <!-- Nombre del paciente -->
        </div>
    </div>
    <div class="row align-items-center pe-4">
        <div class="col-12">
            <!-- Genero del paciente -->
        </div>
    </div>
    <div class="row align-items-center pe-4">
        <div class="col-12">
            <!-- Edad del paciente -->
        </div>
    </div>
</div>

        @else
        <!-- Navbar para cuidadores -->
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
                <a class="nav-link letra-primary-color menu" href="calendario.php">Calendario</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Historia de Vida</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="historiaVida.php">Ver Historia de Vida</a></li>
                    <li><a class="dropdown-item" href="listadoRecuerdos.php">Ver recuerdos</a></li>
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
        <div class="col-12">
            {{ Session::get('paciente')['fecha_nacimiento'] }}
        </div>
    </div>
</div>
        @endif
        </nav>
@endguest


