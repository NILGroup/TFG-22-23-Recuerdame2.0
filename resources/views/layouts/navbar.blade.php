@guest

@else
<!-- Navbar  para usuarios registrados -->
@if(Session::has('paciente'))
<!-- Navbar para terapeutas -->
<nav class="navbar navbar-expand-lg justify-content-left nav-menu yellowbg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-left" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (Auth::user()->rol_id == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sesiones</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/pacientes/{{Session::get('paciente')['id']}}/sesiones">Lista de sesiones</a></li>
                            <li><a class="dropdown-item" href="/pacientes/{{Session::get('paciente')['id']}}/informesSesion">Informes de las sesiones</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link letra-primary-color menu" aria-current="page" href="/pacientes/{{Session::get('paciente')['id']}}/evaluaciones">Evaluaciones</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link letra-primary-color menu" aria-current="page" href="/pacientes/{{ Session::get('paciente')['id'] }}">Paciente</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Historias de Vida</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/pacientes/{{Session::get('paciente')['id']}}/historias/generarHistoria">Generar Historia de Vida</a></li>
                        <li><a class="dropdown-item" href="/pacientes/{{Session::get('paciente')['id']}}/recuerdos/">Ver recuerdos</a></li>
                        @if (Auth::user()->rol_id == 1)
                            <li><a class="dropdown-item" href="/pacientes/{{Session::get('paciente')['id']}}/personas">Personas relacionadas</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link letra-primary-color menu" href="/pacientes/{{Session::get('paciente')['id']}}/calendario">Calendario</a>
                </li>
                @if (Auth::user()->rol_id == 1)
                    <li class="nav-item">
                        <a class="nav-link letra-primary-color menu" href="/pacientes/{{Session::get('paciente')['id']}}/cuidadores">Cuidadores</a>
                    </li>
                @endif
            </ul>
        </div>
        
        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if( Session::get('paciente')['genero_id'] == 1 || Session::get('paciente')['genero_id'] == 3)
                    <a href="/pacientes/{{Session::get('paciente')['id']}}"><img src="/img/avatar_hombre.png" alt="Avatar" class="avatar-mini"></a>
                @elseif( Session::get('paciente')['genero_id'] == 2)
                    <a href="/pacientes/{{Session::get('paciente')['id']}}"><img src="/img/avatar_mujer.png" alt="Avatar" class="avatar-mini"></a>
                @endif
            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                <a class="nav-link letra-primary-color" href="/pacientes/{{$paciente->id}}">{{ Session::get('paciente')['nombre'] }}</a>
            </div>
        </div>

        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if( Session::get('paciente')['genero_id'] == 1)
                    Hombre
                @elseif( Session::get('paciente')['genero_id'] == 2)
                    Mujer
                @else
                    Otro
                @endif
            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">Edad: {{Carbon\Carbon::parse(Session::get('paciente')['fecha_nacimiento'])->age}}
            </div>
        </div>
    </div>
</nav>
@endif

@endguest
