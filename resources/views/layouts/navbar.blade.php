@guest

@else
<!-- Navbar  para usuarios registrados -->
@if(Session::has('paciente'))
<!-- Navbar para terapeutas -->
<nav class="navbar navbar-expand-lg justify-content-left nav-menu yellowbg "  >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-left" id="navbarSupportedContent">
            <ul class="navbar-nav smallMediaLeft d-flex">
                @if (Auth::user()->rol_id == 1)
                <li class="nav-item dropdownClaro dropdown">
                    <a class="nav-linkClaro nav-link dropdown-toggle menu menuLittlemargin"  data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sesiones</a>
                    <ul class="dropdownClaro-menu dropdown-menu">
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/sesiones">Lista de sesiones</a></li>
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/informesSesion">Informes de las sesiones</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdownClaro dropdown">
                    <a class="nav-linkClaro nav-link dropdown-toggle menu menuLittlemargin"  data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Evaluaciones</a>
                    <ul class="dropdownClaro-menu dropdown-menu">
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/diagnostico">Diagnóstico</a></li>
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/evaluaciones">Informes de seguimiento</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-linkClaro nav-link letra-primary-color menu" aria-current="page" href="/usuarios">Usuarios</a>
                </li>
                @endif
                <li class="nav-item dropdownClaro dropdown">
                    <a class="nav-linkClaro nav-link dropdown-toggle letra-primary-color menu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Historias de Vida</a>
                    <ul class="dropdownClaro-menu dropdown-menu">
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/historias/generarHistoria">Generar Historia de Vida</a></li>
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/videos">Ver vídeos</a></li>
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/resumenes">Ver resúmenes</a></li>
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/recuerdos">Ver recuerdos</a></li>
                        @if (Auth::user()->rol_id == 1)
                        <li><a class="dropdownClaro-item dropdown-item" href="/usuarios/{{Session::get('paciente')['id']}}/personas">Personas relacionadas</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <!--<span class="badge bg-danger rounded-pill" style="float:right;margin-bottom:-15px;">1</span>-->
                    <a class="nav-linkClaro nav-link letra-primary-color menu" href="/usuarios/{{Session::get('paciente')['id']}}/calendario">Calendario
                        <!--Hacer que solo se muestre si hay sin finalizar-->
                        @if (Auth::user()->rol_id == 2)
                        <span class="badge badge-pill rounded-pill badge-danger"> {{ App\Http\Controllers\CalendarioController::getNotDone($paciente->id) }}
                        </span>
                        @endif
                    </a>
                </li>
                @if (Auth::user()->rol_id == 1)
                <li class="nav-item">
                    <a class="nav-linkClaro nav-link letra-primary-color menu" href="/usuarios/{{Session::get('paciente')['id']}}/cuidadores">Personas cuidadoras</a>
                </li>
                @endif
            </ul>
        </div>

        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if (!is_null(Session::get('img')))
                    <a href="/usuarios/{{Session::get('paciente')['id']}}"><img src="{{Session::get('img')}}"  alt="Avatar" class="avatar-mini"></a>
                @elseif( Session::get('paciente')['genero_id'] == 1 || Session::get('paciente')['genero_id'] == 3)
                    <a href="/usuarios/{{Session::get('paciente')['id']}}"><img src="/img/avatar_hombre.png" alt="Avatar" class="avatar-mini"></a>
                @elseif( Session::get('paciente')['genero_id'] == 2)
                    <a href="/usuarios/{{Session::get('paciente')['id']}}"><img src="/img/avatar_mujer.png" alt="Avatar" class="avatar-mini"></a>
                @endif
            </div>
        </div>
        <div class="row align-items-center pe-4">
            <div class="col-12">
                <a class="nav-linkClaro nav-link letra-primary-color" href="/usuarios/{{Session::get('paciente')['id']}}">{{ Session::get('paciente')['nombre'] }}</a>
            </div>
        </div>

        <div class="row align-items-center pe-4">
            <div class="col-12">
                @if( Session::get('paciente')['genero_id'] == 1)
                Género: Hombre
                @elseif( Session::get('paciente')['genero_id'] == 2)
                Género: Mujer
                @else
                    @if(!is_null(Session::get('paciente')['genero_custom']) && Session::get('paciente')['genero_id'] == "3")
                        Género: {{Session::get('paciente')['genero_custom']}}
                    @else
                        Género: Otro
                    @endif
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