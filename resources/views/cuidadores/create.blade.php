@extends('layouts.structure')

@section('content')
<div class="container-fluid">
        <!--<!?php
        if (Session::getIdPaciente() != null) {
            $pacientesController = new PacientesController();
            $paciente = $pacientesController->verPaciente(Session::getIdPaciente());
        } else {
            $pacientesController = new PacientesController();
        }
        ?>-->
         <div class="pt-4 pb-2">
            <h5 class="text-muted">Registro cuidador</h5>
            <hr class="lineaTitulo">
        </div>

        <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input type="text" class="form-control form-control-sm" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>
                        @error('apellidos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="nick" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre de usuario<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" placeholder="Nombre de Usuario" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>

                        @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Correo<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-7">
                    <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contraseña<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!--TODO:: A PARTIR DE AQUÍ-->
            <div class="row form-group justify-content-between">
                <div class="row col-sm-12 col-md-6 col-lg-5">
                    <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Paciente<span class="asterisco">*</span></label>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <select class="form-select form-select-sm" id="paciente" name="paciente" required>
                            <option value="" selected="selected"></option>
                            <?php
                                    
                                    $pacientesCuidador = $pacientesController->getListaPacientesSinCuidador($usuario->getIdUsuario());
                                     if($pacientesCuidador != null){
                                        foreach ($pacientesCuidador as $fila) {
                                           
                                            $id = $fila['id_paciente'];
                                            $nombre = $fila['nombre'];
                                            $apellido = $fila['apellidos'];

                                        ?>
                                    <option value=" <?php echo $id; ?>"> <?php echo $nombre . " " . $apellido; ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>
            </div>
<!--------------------------------------->
            <input id="rol" type="hidden" name="rol" value=2 required autocomplete="apellidos" autofocus>

            <div class="col-12">
                <button type="submit" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
                <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
            </div>
        </form>
    </div>
@endsection