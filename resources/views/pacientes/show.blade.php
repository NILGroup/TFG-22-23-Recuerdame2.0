@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>

    <form method="get" action="/pacientes/{{$paciente->id}}">
        <div class="card p-4 h-80">
            <div class="row justify-content-center p-3">
                <div class="row col-sm-6 col-md-4 col-lg-2">
                    <img src="<?php if ($paciente->genero == 'H') echo '/img/avatar_hombre.png';
                                else if ($paciente->genero == 'M') echo '/img/avatar_mujer.png'; ?> " alt="Avatar" class="avatar img-thumbnail">
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
                            <input type="text" disabled class="form-control form-control-sm" id="genero" value="<?php if ($paciente->genero == 'H') echo 'Hombre';
                                                                                                                else if ($paciente->genero == 'M') echo 'Mujer'; ?>  ">
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

                @if(!is_null($cuidador)))
                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="cuidador" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Cuidador</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <input type="text" disabled class="form-control form-control-sm" id="cuidador" value="{{$cuidador->nombre}} {{$cuidador->apellidos}}">
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
            <div class="col-12">
                <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
            </div>
    </form>
</div>

@endsection