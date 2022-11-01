@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/pacientes/{{$paciente->id}}">

    
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}" required>
                    {{csrf_field()}}

                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="genero" name="genero" class="form-control form-select form-select-sm" required>
                        <option selected disabled></option>
                            @foreach($generos as $genero)
                                <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" value="{{$paciente->nacionalidad}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" value="{{$paciente->fecha_nacimiento}}"required>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="lugarNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Estado civil<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="estado" name="estado_id" class="form-control form-select form-select-sm" required>
                        
                        @foreach($situaciones as $situacion)
                            <option value="{{$situacion->id}}" @if($situacion->id == $paciente->situacion_id) selected @endif>{{$situacion->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$paciente->ocupacion}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="fecha_inscripcion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de inscripción<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="date" name="fecha_inscripcion" class="form-control form-control-sm" id="fecha_inscipcion" value="{{$paciente->fecha_inscripcion}}" required>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="estudios" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nivel de estudios<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" required>
                        
                    @foreach($estudios as $estudio)
                        <option value="{{$estudio->id}}" @if($estudio->id == $paciente->estudio_id) selected @endif>{{$estudio->nombre}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="residencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia<span class="asterisco">*</span></label>
                
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="residencia" name="tipo_residencia" class="form-control form-select form-select-sm" required>
                        @foreach($residencias as $residencia)
                            <option value="{{$residencia->id}}" @if($residencia->id == $paciente->residencia_id) selected @endif>{{$residencia->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Dirección del domicilio<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" value="{{$paciente->residencia_actual}}" required>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush