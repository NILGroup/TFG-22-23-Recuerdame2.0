<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="public/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
    <title>Recuérdame</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <div class="container-fluid">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Datos paciente</h5>
            <hr class="lineaTitulo">
        </div>

        <form method="post" action="/pacientes/{{$paciente->id}}">
            <div class="card p-4 h-80">
                <div class="row justify-content-center p-3">
                    <img src="avatar_hombre.png" alt="Avatar" class="avatar img-thumbnail">
                </div>
                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" disabled class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}">
                        </div>
                    </div>

                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos</label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" disabled class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}">
                        </div>
                    </div>
                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <!--TODO: distinguir entre hombre y mujer -->
                            <input type="text" disabled class="form-control form-control-sm" id="genero" value="">
                        </div>
                    </div>

                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento</label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" disabled class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}">
                        </div>
                    </div>
                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="fechaNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" disabled class="form-control form-control-sm" id="fechaNacimiento" value="{{$paciente->fecha_nacimiento}}">
                        </div>
                    </div>

                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="nacionalidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad</label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" disabled class="form-control form-control-sm" id="nacionalidad" value="{{$paciente->nacionalidad}}">
                        </div>
                    </div>
                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="tipoResidencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" disabled class="form-control form-control-sm" id="tipoResidencia" value="{{$paciente->tipo_residencia}}">
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="residenciaActual" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Residencia actual</label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" disabled class="form-control form-control-sm" id="residenciaActual" value="{{$paciente->residencia_actual}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
            </div>
        </form>
    </div>
</body>