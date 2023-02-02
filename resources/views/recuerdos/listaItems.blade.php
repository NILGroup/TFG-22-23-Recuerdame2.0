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
        <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del estado recuerdo">Estado <i class="bi bi-question-circle"></i></label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <select class="form-select form-select-sm" id="idEstado" name="estado_id" @if($show) disabled @endif>
                @foreach ($estados as $estado)
                <option value="{{$estado->id}}" @if($estado->id == $recuerdo->estado_id) selected @endif>{{$estado->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row justify-content-between">
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <input type="date" class="form-control form-control-sm" id="fecha" required name="fecha" value="{{$recuerdo->fecha}}" @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-6">
        <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del recuerdo">Etiqueta <i class="bi bi-question-circle"></i></label>
        <div class="col-sm-9 col-md-6 col-lg-4">
            <select class="form-select form-select-sm" id="idEtiqueta" name="etiqueta_id" @if($show) disabled @endif>
                @foreach ($etiquetas as $etiqueta)
                <option value="{{$etiqueta->id}}" @if($etiqueta->id == $recuerdo->etiqueta_id) selected @endif>{{$etiqueta->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="row col-sm-12 col-md-12 col-lg-12">
        <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1" data-toggle="tooltip" data-placement="top" title="Grado de positividad de la emoción generada al paciente por el recuerdo">Puntuación <i class="bi bi-question-circle"></i></label>

        <div class="col-md-auto">0 <i class="bi bi-emoji-frown-fill text-danger"></i></div>
        <div class="col-sm-auto col-md-auto col-lg-auto">
            <div class="range-wrap">
                <div class="range-value" id="rangeV"></div>
                <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion" @if($show) disabled @endif>
            </div>
        </div>
        <div class="col mx-auto">10 <i class="bi bi-emoji-smile-fill text-success"></i></div>
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
                <option value="{{$etiqueta->id}}" @if($etiqueta->id == $recuerdo->etiqueta_id) selected @endif>{{$etapa->nombre}}</option>
                @endforeach
            </select>
        </div>

        <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1" data-toggle="tooltip" data-placement="top" title="Emoción que estima el terapeuta que el recuerdo le ha generado al paciente">Emoción producida <i class="bi bi-question-circle"></i></label>
        <div class="col-sm-3 col-md-3 col-lg-2">
            <select class="form-select form-select-sm" id="idEmocion" name="emocion_id" @if($show) disabled @endif>
                @foreach ($emociones as $emocion)
                <option value="{{$emocion->id}}" @if($emocion->id == $recuerdo->emocion_id) selected @endif>{{$emocion->nombre}}</option>
                @endforeach
            </select>
        </div>
        <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
        <div class="col-sm-3 col-md-3 col-lg-2">
            <select onchange="especifiqueCategoria()" style="margin-right: 5px" class="form-select form-select-sm form-control" id="categoria_id" name="categoria_id" @if($show) disabled @endif>
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}" @if($categoria->id == $recuerdo->categoria_id) selected @endif>{{$categoria->nombre}}</option>
                @endforeach
            </select>
            <input @if($recuerdo->categoria_id != 7) style="display: none;" @endif type="text" name="tipo_custom" value="{{$recuerdo->tipo_custom}}" class="form-control form-control-sm" id = "tipo_custom" @if($show) disabled @endif>
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
<div class="tabla">
    <div class="d-flex justify-content-between upper">
        @include('layouts.tableSearcher')
        @if(!$show)
        <div class="justify-content-end d-flex p-2">
            <!-- Nueva persona relacionada -->
            <button type="button" name="crearPersona" id="crearPersona" class="btn btn-success me-2 showmodal" @if(!str_contains(url()->current(), 'recuerdo')) data-show-modal="personasCreator" @else data-bs-toggle="modal" data-bs-target="#personasCreator" @endif><i class="fa-solid fa-plus"></i></button>
            <!-- Persona existente -->
            <button type="button" name="anadiendoPersona" class="btn btn-success me-2 showmodal" @if(!str_contains(url()->current(), 'recuerdo')) data-show-modal="personasExistentes" @else data-bs-toggle="modal" data-bs-target="#personasExistentes" @endif>Añadir existente</button>
        </div>
        @endif  
    </div>
    <table id="tabla" class="table table-bordered table-striped table-responsive datatable tablaPersonaRecuerdo" style="width: 100%;">
        <caption>Listado de personas relacionadas</caption>
        <thead>
            <tr class="bg-primary">
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th class="fit10" scope="col">Tipo de relación</th>
                @if($show)
                <th class="fit5" scope="col"></th>
                @endif
            </tr>
        </thead>
        <tbody id="divPersonas">
            @foreach ($recuerdo->personas_relacionadas as $persona)
            <tr>
                <td><a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}">{{$persona->nombre}}</a></td>
                <td>{{$persona->apellidos}}</td>
                <td>{{$persona->tiporelacion->nombre}}</td>
                <input type="hidden" value={{$persona->id}}>
                @if($show)
                <td class="tableActions">
                    <a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                </td>
                @endif
            </tr>
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
@if($show)
<div id="showMultimedia" class="row pb-2">
    @foreach ($recuerdo->multimedias as $media)
        @include("layouts.multimedia")


    @endforeach
</div>
@endif


@push('styles')
<link rel="stylesheet" href="/css/slider.css">
<link rel="stylesheet" href="/css/imagen.css">
@endpush

@push('scripts')
    <script src="/js/especificar.js"></script>
    <script src="/js/puntuacionRecuerdo.js"></script>
@endpush