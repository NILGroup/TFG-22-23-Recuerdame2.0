<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recuérdame</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         <script src="public/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
        <!-- Styles 
        <style>
           

        </style>-->

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
        <form  method="post" action="/pacientes" >

            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" required >
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                    </div>
                </div>
                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" required>
                    </div>
                </div>
            </div>

            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <select id="genero" name="genero" class="form-select form-select-sm">
                                                        
                           <option value="H" selected>Hombre</option> 
                           <option value="M" >Mujer</option>
                          
                        </select>
                    </div>
                </div>
                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="lugarNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" placeholder="Ciudad..." required>
                    </div>
                </div>
            </div>

            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha"required >
                    </div>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" placeholder="Nacionalidad..." required>
                    </div>
                </div>
            </div>

            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="residencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input type="text" name="tipo_residencia" class="form-control form-control-sm" id="residencia" required>
                    </div>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Residencia actual<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" required>
                    </div>
                </div>
            </div>

            <div class="col-12">
            <button type="submit"value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>