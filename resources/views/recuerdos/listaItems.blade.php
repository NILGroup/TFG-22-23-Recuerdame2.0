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
        <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del estado recuerdo">Estado</label>
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
        <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del recuerdo">Etiqueta</label>
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
        <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1" data-toggle="tooltip" data-placement="top" title="Grado de positividad de la emoción generada al paciente por el recuerdo">Puntuación</label>

        <div class="col-md-auto">0 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm-2.715 5.933a.5.5 0 0 1-.183-.683A4.498 4.498 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.498 3.498 0 0 0 8 10.5a3.498 3.498 0 0 0-3.032 1.75.5.5 0 0 1-.683.183zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
</svg></div>
        <div class="col-sm-auto col-md-auto col-lg-auto">
            <div class="range-wrap">
                <div class="range-value" id="rangeV"></div>
                <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion" @if($show) disabled @endif>
            </div>
        </div>
        <div class="col mx-auto">10 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
</svg></div>
    </div>

    <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" @if($show) disabled @endif>{{$recuerdo->descripcion}}</textarea>
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

        <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1" data-toggle="tooltip" data-placement="top" title="Emoción que estima el terapeuta que el recuerdo le ha generado al paciente">Emoción producida</label>
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
                @if($show)
                <th scope="col"></th>
                @endif
            </tr>
        </thead>
        <tbody id="divPersonas">
            <?php $n = 1; ?>
            @foreach ($recuerdo->personas_relacionadas as $persona)
            <tr>
                <th scope="row"><?php echo $n; ?></th>
                <td><a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}">{{$persona->nombre}}</a></td>
                <td>{{$persona->apellidos}}</td>
                <td>{{$persona->tiporelacion_id}}</td>
                <input type="hidden" value={{$persona->id}}>
                @if($show)
                <td class="tableActions">
                    <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                </td>
                @endif
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

@push('styles')
<link rel="stylesheet" href="/css/slider.css">
@endpush
@push('scripts')
<script>
        const
            range = document.getElementById('puntuacion'),
            rangeV = document.getElementById('rangeV'),
            setValue = () => {
                const
                    newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                    newPosition = 10 - (newValue * 0.2);
                rangeV.innerHTML = `<span>${range.value}</span>`;
                rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
            };
        document.addEventListener("DOMContentLoaded", setValue);
        range.addEventListener('input', setValue);
    </script>
    @endpush