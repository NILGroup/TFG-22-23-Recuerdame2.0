@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>
    @include('pacientes.listaItems')
    <!--
    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}" disabled>
                {{csrf_field()}}

            </div>
        </div>
        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="genero" name="genero" class="form-control form-select form-select-sm" disabled>
                    @foreach($generos as $genero)
                        <option value="{{$genero->id}}" @if($genero->id == $paciente->genero_id) selected @endif>{{$genero->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" value="{{$paciente->nacionalidad}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" value="{{$paciente->fecha_nacimiento}}"disabled>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="lugarNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Estado civil </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="estado" name="estado_id" class="form-control form-select form-select-sm" disabled>
                    @foreach($situaciones as $situacion)
                        <option value="{{$situacion->id}}" @if($situacion->id == $paciente->situacion_id) selected @endif>{{$situacion->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$paciente->ocupacion}}" disabled>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="fecha_inscripcion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de inscripción </label>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <input type="date" name="fecha_inscripcion" class="form-control form-control-sm" id="fecha_inscipcion" value="{{$paciente->fecha_inscripcion}}" disabled>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="estudios" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nivel de estudios </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" disabled>
                    @foreach($estudios as $estudio)
                        <option value="{{$estudio->id}}" @if($estudio->id == $paciente->estudio_id) selected @endif>{{$estudio->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row form-group justify-content-between">
        <div class="row col-sm-12 col-md-6 col-lg-5">
            <label for="residencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia </label>
            
            <div class="col-sm-12 col-md-12 col-lg-6">
                <select id="residencia" name="tipo_residencia" class="form-control form-select form-select-sm" disabled>
                    @foreach($residencias as $residencia)
                        <option value="{{$residencia->id}}" @if($residencia->id == $paciente->residencia_id) selected @endif>{{$residencia->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row col-sm-12 col-md-6 col-lg-7">
            <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Dirección del domicilio </label>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" value="{{$paciente->residencia_actual}}" disabled>
            </div>
        </div>
    </div>
    -->
    @include('pacientes.desplegables')

    <div class="col-12">
        <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script>
        $(document).ready(function () {
            $('#tabla1').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });

            $('#tabla2').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });

            $('#tabla3').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });
        });
    </script>

@endpush