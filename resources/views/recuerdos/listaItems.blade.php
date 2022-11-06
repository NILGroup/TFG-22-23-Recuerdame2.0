<input type="hidden" name="id" id="id" value="{{$recuerdo->id}}">
<input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">
<div class="row form-group justify-content-between">
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-9 col-lg-9">
            <input type="text" name="nombre" value="{{$recuerdo->nombre}}" class="form-control form-control-sm" id="nombre" maxlength="50" required @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Estado</label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <select class="form-select form-select-sm" id="idEstado" name="estado_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($estados as $estado)
                <option value="{{$estado->id}}" @if($estado->id == $recuerdo->estado_id) selected @endif>{{$estado->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row justify-content-between">
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2" >Fecha<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <input type="date" class="form-control form-control-sm" id="fecha" required name="fecha" value="{{$recuerdo->fecha}}" @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <select class="form-select form-select-sm" id="idEtiqueta" name="etiqueta_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($etiquetas as $etiqueta)
                <option value="{{$etiqueta->id}}" @if($etiqueta->id == $recuerdo->etiqueta_id) selected @endif>{{$etiqueta->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="row col-sm-12 col-md-12 col-lg-12">
        <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1">Puntuación</label>

        <div class="col-md-auto">0</div>
        <div class="col-sm-auto col-md-auto col-lg-auto">
            <div class="range-wrap">
                <div class="range-value" id="rangeV"></div>
                <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion">
            </div>
        </div>
        <div class="col mx-auto">10</div>
    </div>

    <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3">{{$recuerdo->descripcion}}</textarea>
</div>
<div class="row justify-content-between">
    <div class="row">
        <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida<span class="asterisco">*</span></label>
        <div class="col-sm-3 col-md-3 col-lg-2">
            <select class="form-select form-select-sm" id="idEtapa" name="etapa_id" required @if($show) disabled @endif>
                @foreach ($etapas as $etapa)
                <option selected="true" value="{{$etiqueta->id}}" @if($etiqueta->id == $recuerdo->etiqueta_id) selected @endif>{{$etapa->nombre}}</option>
                @endforeach
            </select>
        </div>

        <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
        <div class="col-sm-3 col-md-3 col-lg-2">
            <select class="form-select form-select-sm" id="idEmocion" name="emocion_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($emociones as $emocion)
                <option value="{{$emocion->id}}" @if($emocion->id == $recuerdo->emocion_id) selected @endif>{{$emocion->nombre}}</option>
                @endforeach
            </select>
        </div>
        <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
        <div class="col-sm-3 col-md-3 col-lg-2">
            <select class="form-select form-select-sm" id="idCategoria" name="categoria_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}" @if($categoria->id == $recuerdo->categoria_id) selected @endif>{{$categoria->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="localizacion" class="form-label col-form-label-sm">Localización</label>
    <textarea maxlength="255" class="form-control form-control-sm" id="localizacion" name="localizacion" rows="3" @if($show) disabled @endif>{{$recuerdo->localizacion}}</textarea>
</div>
<div class="pt-4 pb-2">
    <h5 class="text-muted">Listado de personas relacionadas</h5>
    <hr class="lineaTitulo">
</div>
@if(!$show)
<div class="row">
    <div class="col-12 justify-content-end d-flex p-2">
        <!-- Nueva persona relacionada -->
        <button type="button" name="crearPersona" class="btn btn-success btn-sm btn-icon me-2" data-bs-toggle="modal" data-bs-target="#personasCreator"><i class="fa-solid fa-plus"></i></button>
        <!-- Persona existente -->
        <button type="button" name="anadiendoPersona" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#personasExistentes">Añadir existente</button>
    </div>
</div> <!-- col 12 -->
@endif
<div>
    <table id="tabla" class="table table-bordered table-striped table-responsive">
        <caption>Listado de personas relacionadas</caption>
        <thead>
            <tr class="bg-primary">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Tipo de relación/parentesco</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="divPersonas">
            <?php $n = 1; ?>
            @foreach ($recuerdo->personas_relacionadas as $persona)
            <tr>
                <th scope="row"><?php echo $n; ?></th>
                <td><a href="{{route('personas.show', $persona->id)}}">{{$persona->nombre}}</a></td>
                <td>{{$persona->apellidos}}</td>
                <td>{{$persona->tiporelacion_id}}</td>
                <input type="hidden" value={{$persona->id}}>
                <td class="tableActions">
                    <a href="{{route('personas.show', $persona->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                </td>
            </tr>
            <?php $n++ ?>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pt-4 pb-2">
    <h5 class="text-muted">Material</h5>
    <hr class="lineaTitulo">
</div>

<div class="row">
    <div class="col-12 justify-content-end d-flex p-2">
    </div>
</div>
@if(!$show)
<div class="dropzone dropzone-previews dropzone-custom" id="my-awesome-dropzone">
    <div class="dz-message text-muted" data-dz-message>
        <span>Click aquí o arrastrar y soltar</span>
    </div>
</div>
@endif
<div id="showMultimedia" class="row pb-2">
    @foreach ($recuerdo->multimedias as $media)
    <div class="col-sm-4 p-2">
        <div class="img-wrap">
            <a href="#" class="visualizarImagen"><img src="/img/{{$media->fichero}}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon"></a>
        </div>
    </div>
    @endforeach
</div>