<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}" required @if($show) disabled @endif>

        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="apellidos" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="genero" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Género<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="genero" name="genero" class="form-control form-select form-select-sm" required @if($show) disabled @endif>
                <option selected disabled></option>
                    @foreach($generos as $genero)
                        <option value="{{$genero->id}}" @if($genero->id == $paciente->genero_id) selected @endif>{{$genero->nombre}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    
    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="pais" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nacionalidad<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" value="{{$paciente->nacionalidad}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="fecha" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de nacimiento<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" value="{{$paciente->fecha_nacimiento}}"required @if($show) disabled @endif>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="lugarNacimiento" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Lugar de nacimiento<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="estado" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Estado civil<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="estado" name="estado_id" class="form-control form-select form-select-sm" required @if($show) disabled @endif>
                <option selected disabled></option>
                @foreach($situaciones as $situacion)
                    <option value="{{$situacion->id}}" @if($situacion->id == $paciente->situacion_id) selected @endif>{{$situacion->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$paciente->ocupacion}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5">
        <label for="fecha_inscripcion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Fecha de inscripción<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="date" name="fecha_inscripcion" class="form-control form-control-sm" id="fecha_inscipcion" value="{{$paciente->fecha_inscripcion}}" required @if($show) disabled @endif>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="estudios" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Nivel de estudios<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" required @if($show) disabled @endif>
                <option selected disabled></option>
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
            <select id="residencia" name="tipo_residencia" class="form-control form-select form-select-sm" required @if($show) disabled @endif>
                    <option selected disabled></option>
                @foreach($residencias as $residencia)
                    <option value="{{$residencia->id}}" @if($residencia->id == $paciente->residencia_id) selected @endif>{{$residencia->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7">
        <label for="casa" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Dirección del domicilio<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" value="{{$paciente->residencia_actual}}" required @if($show) disabled @endif>
        </div>
    </div>
</div>