<div id="esta" class="row text-align-center">
    @if($mostrarFoto)
    <div class="col-lg-3 align-items-center" style="padding-right: 50px!important;">
        @include('personasrelacionadas.foto')
    </div>
    @endif
    <div class= @if($mostrarFoto) "col-lg-9" @endif "col-lg-12">

        <input type="hidden" name="paciente_id" class="form-control form-control-sm" id="paciente_id" value="{{$idPaciente}}" required>
        <input type="hidden" name="id" class="form-control form-control-sm" id="id" value="{{$persona->id}}" required>
        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="nombre" class="form-label col-form-label col-sm-12 col-md-6 col-lg-3 negrita">Nombre:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8 ">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" value="{{$persona->nombre}}" required>
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="apellidos" class="form-label col-form-label col-sm-12 col-md-5 col-lg-4 negrita">Apellidos:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8 ">
                    <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" value="{{$persona->apellidos}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between ">
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="telefono" class="form-label col-form-label col-sm-12 col-md-6 col-lg-3 negrita">Teléfono:</label>
                <div class="col-sm-12 col-md-6 col-lg-8 ">
                    <input type="tel" pattern="[0-9]{9}" name="telefono" class="form-control form-control-sm" id="telefono" value="{{$persona->telefono}}">
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="ocupacion" class="form-label col-form-label negrita col-sm-12 col-md-5 col-lg-4">Ocupación:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8 ">
                    <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" value="{{$persona->ocupacion}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="email" class="form-label col-form-label negrita col-sm-12 col-md-6 col-lg-3">Email:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8">
                    <input type="email" name="email" class="form-control form-control-sm" id="email" value="{{$persona->email}}" required>
                </div>
            </div>
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="localidad" class="form-label col-form-label negrita col-sm-12 col-md-5 col-lg-4">Dirección:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8 ">
                    <input type="text" name="localidad" class="form-control form-control-sm" id="localidad" value="{{$persona->localidad}}" required>
                </div>
            </div>
        </div>

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="tipo" class="form-label col-form-label negrita col-sm-12 col-md-6 col-lg-3">Tipo de relación:<span class="asterisco">*</span></label>
                <div class="col-sm-12 col-md-6 col-lg-8 align-items-center">

                    <select onchange="especifique()" style="margin-right: 5px" class="form-select form-select-sm form-control" id="tiporelacion_id" name="tiporelacion_id">
                        @foreach ($tipos as $tipo)
                        <option value="{{$tipo->id}}" @if($tipo->id == $persona->tiporelacion_id) selected @endif>{{$tipo->nombre}}</option>
                        @endforeach
                    </select>
                    <input @if($persona->tiporelacion_id != 7) style="display: none;" @endif type="text" name="tipo_custom" value="{{$persona->tipo_custom}}" class="form-control form-control-sm" id = "tipo_custom" >
                </div>
            </div>

            <div class="row col-sm-12 col-md-6 col-lg-6 align-items-center">
                <label for="contacto" class="form-label col-form-label negrita col-sm-12 col-md-5 col-lg-4">Contacto: <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="Indicar si se trata del contacto preferente para este usuario"></i></label>
                <div class="col-sm-12 col-md-6 col-lg-5">
                    <input type="checkbox" name="contacto" class="form-check-input" id="contacto" value="x" @if($persona->contacto) checked @endif >

                </div>
            </div>
        </div>
        <div class="row form-group justify-content-between">
            <div class="mb-3 mt-3">
                <label for="observaciones" class="form-label col-form-label negrita">Observaciones:</label>
                <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3">{{$persona->observaciones}}</textarea>
            </div>
        </div>
    </div>
</div>