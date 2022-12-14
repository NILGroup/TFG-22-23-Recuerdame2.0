@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <form method="post" action="/pacientes">
        {{csrf_field()}}
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Crear paciente</h5>
            <hr class="lineaTitulo">
        </div>
        @include('pacientes.listaItems')
        <!--
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" placeholder="Nombre..." required>

                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" placeholder="Apellidos..." required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="genero" name="genero_id" class="form-control form-select form-select-sm" required>
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
                    <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" placeholder="Nacionalidad..." required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" required>
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
                <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Estado civil<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="estado" name="situacion_id" class="form-control form-select form-select-sm" required>
                        <option selected disabled></option>
                        @foreach($situaciones as $situacion)
                            <option value="{{$situacion->id}}">{{$situacion->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" placeholder="Ocupación laboral..." required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="fecha_inscripcion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de inscripción<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="date" name="fecha_inscripcion" class="form-control form-control-sm" id="fecha_inscipcion" required>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="estudios" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nivel de estudios<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" required>
                        <option selected disabled></option>
                        @foreach($estudios as $estudio)
                            <option value="{{$estudio->id}}">{{$estudio->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="residencia" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo de residencia<span class="asterisco">*</span></label>
                
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <select id="residencia" name="residencia_id" class="form-control form-select form-select-sm" required>
                        <option selected disabled></option>
                        @foreach($residencias as $residencia)
                            <option value="{{$residencia->id}}">{{$residencia->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-7">
                <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Dirección del domicilio<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" placeholder="Dirección..." required>
                </div>
            </div>
        </div>
        -->
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush