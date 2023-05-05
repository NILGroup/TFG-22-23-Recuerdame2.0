

<div class="row form-group justify-content-between">
    <input type="hidden" name="id" class="form-control form-control-sm" id="paciente_id" value="{{$paciente->id}}"  >
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="nombre" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Nombre:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$paciente->nombre}}" required >
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="apellidos" class=" form-label col-form-label col-sm-12 col-md-12 col-lg-4"><strong>Apellidos:</strong><span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$paciente->apellidos}}" required >
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="genero" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Género:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="genero" name="genero_id" class="form-control form-select form-select-sm" required >
                <option selected disabled></option>
                    @foreach($generos as $genero)
                        <option value="{{$genero->id}}" @if($genero->id == $paciente->genero_id) selected @endif>{{$genero->nombre}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    
    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="pais" class="form-label col-form-label col-sm-12 col-md-12 col-lg-4 negrita">Nacionalidad:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="nacionalidad" class="form-control form-control-sm" id="pais" value="{{$paciente->nacionalidad}}" required >
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="fecha" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Fecha de nacimiento:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <input max="4000-12-31" min="1800-01-01" type="date" name="fecha_nacimiento" class="form-control form-control-sm" id="fecha" value="{{$paciente->fecha_nacimiento}}"required >
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="lugarNacimiento" class="form-label col-form-label col-sm-12 col-md-12 col-lg-4 negrita">Lugar de nacimiento:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="lugar_nacimiento" class="form-control form-control-sm" id="lugarNacimiento" value="{{$paciente->lugar_nacimiento}}" required >
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="estado" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Estado civil:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="estado" name="situacion_id" class="form-control form-select form-select-sm" required >
                <option selected disabled></option>
                @foreach($situaciones as $situacion)
                    <option value="{{$situacion->id}}" @if($situacion->id == $paciente->situacion_id) selected @endif>{{$situacion->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="ocupacion" class="form-label col-form-label col-sm-12 col-md-12 col-lg-4 negrita">Ocupación:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$paciente->ocupacion}}" required >
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="estudios" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Nivel de estudios:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="estudios" name="estudio_id" class="form-control form-select form-select-sm" required >
                <option selected disabled></option>
            @foreach($estudios as $estudio)
                <option value="{{$estudio->id}}" @if($estudio->id == $paciente->estudio_id) selected @endif>{{$estudio->nombre}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="casa" class="form-label col-form-label col-sm-12 col-md-12 col-lg-4 negrita">Dirección del domicilio:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="residencia_actual" class="form-control form-control-sm" id="casa" value="{{$paciente->residencia_actual}}" required >
        </div>
    </div>
</div>

<div class="row form-group justify-content-between">
    <div class="row col-sm-12 col-md-6 col-lg-5 align-items-center">
        <label for="residencia" class="form-label col-form-label col-sm-12 col-md-12 col-lg-6 negrita">Tipo de residencia:<span class="asterisco">*</span></label>
        
        <div class="col-sm-12 col-md-12 col-lg-6">
            <select id="residencia" onchange="especifiqueResidencia()" style="margin-right: 5px" id="residencia" name="residencia_id" class="form-control form-select form-select-sm" required >
                <option selected disabled></option>
                @foreach($residencias as $residencia)
                    <option value="{{$residencia->id}}" @if($residencia->id == $paciente->residencia_id) selected @endif>{{$residencia->nombre}}</option>
                @endforeach
            </select>   
            </div>
    </div>

    <div id="fecha_inscipcion" @if($paciente->residencia_id != 5) style="display: none;" @endif class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="fecha_inscripcion" class="form-label col-form-label negrita col-sm-12 col-md-12 col-lg-4">Fecha de inscripción<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8 ">
            <input max="4000-12-31" min="1800-01-01" type="date" name="fecha_inscripcion" class="form-control form-control-sm" value="{{$paciente->fecha_inscripcion}}" >
        </div>
    </div>

    <div id="residencia_custom" @if($paciente->residencia_id != 6) style="display: none;" @endif class="row col-sm-12 col-md-6 col-lg-7 align-items-center">
        <label for="residencia_custom" class="form-label col-form-label-sm negrita col-sm-12 col-md-12 col-lg-4">Especifique:<span class="asterisco">*</span></label>
        <div class="col-sm-12 col-md-12 col-lg-8">
            <input type="text" name="residencia_custom" value="{{$paciente->residencia_custom}}" class="form-control form-control-sm" id ="residencia_custom" >
        </div>
    </div>
</div>