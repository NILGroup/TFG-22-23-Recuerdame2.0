<input type="hidden" name="id" id="id" value="{{$recuerdo->id}}">
<input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">
<input type="hidden" name="recuerdo_id" id="recuerdo_id" value="">
<div class="row form-group justify-content-start">
    <div class="row col-sm-6 col-md-5 col-lg-4 align-items-center">
        <label for="nombre" class="form-label col-form-label negrita col-sm-3 col-md-3 col-lg-3">Nombre:<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-9 col-lg-8 align-items-center">
            <input type="text" name="nombre" value="{{$recuerdo->nombre}}" class="form-control form-control-sm" id="nombre" maxlength="50" required @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-6 align-items-center">
        <label for="estado" class="form-label col-form-label negrita col-sm-3 col-md-4 col-lg-2">Estado: <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del estado recuerdo"></i></label>
        <div class="col-sm-9 col-md-6 col-lg-4 align-items-center">
            <select class="form-select form-select-sm" id="idEstado" name="estado_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($estados as $estado)
                <option value="{{$estado->id}}" @if($estado->id == $recuerdo->estado_id) selected @endif>{{$estado->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row justify-content-start">
    <div class="row col-sm-6 col-md-5 col-lg-4 align-items-center">
        <label for="fecha" class="form-label col-form-label negrita col-sm-3 col-md-3 col-lg-3">Fecha:<span class="asterisco">*</span></label>
        <div class="col-sm-9 col-md-6 col-lg-5 align-items-center">
            <input max="4000-12-31" min="1800-01-01" type="date" class="form-control form-control-sm" id="fecha" required name="fecha" value="{{$recuerdo->fecha}}" @if($show) disabled @endif>
        </div>
    </div>
    <div class="row col-sm-6 col-md-6 col-lg-6 align-items-center">
        <label for="idEtiqueta" class="form-label col-form-label negrita col-sm-3 col-md-4 col-lg-2">Etiqueta: <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="left" title="Valoración del terapeuta del recuerdo"></i></label>
        <div class="col-sm-9 col-md-6 col-lg-4 align-items-center">
            <select class="form-select form-select-sm" id="idEtiqueta" name="etiqueta_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($etiquetas as $etiqueta)
                <option value="{{$etiqueta->id}}" @if($etiqueta->id == $recuerdo->etiqueta_id) selected @endif>{{$etiqueta->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row justify-content-start">
    <div class="row col-sm-6 col-md-5 col-lg-4 align-items-center">
        <label for="apto" class="form-label col-form-label negrita col-sm-3 col-md-3 col-lg-3">Apto:<i class="bi bi-question-circle" data-toggle="tooltip" data-placement="right" title="Marca esta opción si el recuerdo sigue siendo apto para trabajar con él."></i></label>
        <div class="col-sm-9 col-md-6 col-lg-5 align-items-center">
        <input class="form-check-input" type="checkbox" name="apto" value="1" id="apto" @if($recuerdo->apto) checked @endif @if($show) disabled @endif>        </div>
    </div>
</div>

<div class="row mt-3 ">
    <div class="row col-sm-12 col-md-12 col-lg-8 align-items-center ">
        <label for="puntuacion" class="form-label col-form-label negrita col-sm-2 col-md-2 col-lg-2">Puntuación: <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="Grado de positividad de la emoción generada al paciente por el recuerdo"></i></label>

        <div class="d-flex align-items-center">
            <div class="col-md-auto ">0 <i class="bi bi-emoji-frown-fill text-danger"></i></div>
            <div class="col-sm-auto col-md-auto col-lg-auto">
                <div class="range-wrap m-1">
                    <div class="range-value" id="rangeV"></div>
                    <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value={{$recuerdo->puntuacion}} @if($show) disabled @endif>
                </div>
            </div>
            <div class="col mx-auto ">10 <i class="bi bi-emoji-smile-fill text-success"></i></div>
        </div>
    </div>

    <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label col-form-label negrita">Descripción:</label>
    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" @if($show) disabled @endif>{{$recuerdo->descripcion}}</textarea>
</div>

<div class="row form-group justify-content-start">
    <div class="row col-sm-5 col-md-4 col-lg-4 align-items-center ">
        <label for="etapa" class="form-label col-form-label negrita col-sm-5 col-md-4 col-lg-4">Etapa de la vida:<span class="asterisco">*</span></label>
        <div class="col-sm-3 col-md-4 col-lg-5 align-items-center">
            <select class="form-select form-select-sm" id="idEtapa" name="etapa_id" required @if($show) disabled @endif>
                <option></option>
                @foreach ($etapas as $etapa)
                <option value="{{$etapa->id}}" @if($etapa->id == $recuerdo->etapa_id) selected @endif>{{$etapa->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row col-sm-4 col-md-4 col-lg-4 align-items-center">
        <label for="emocion" class="form-label col-form-label negrita col-sm-7 col-md-5 col-lg-5">Emoción producida: <i class="bi bi-question-circle" data-toggle="tooltip" data-placement="top" title="Emoción que estima el terapeuta que el recuerdo le ha generado al paciente"></i></label>
        <div class="col-sm-3 col-md-3 col-lg-5 align-items-center">
            <select class="form-select form-select-sm" id="idEmocion" name="emocion_id" @if($show) disabled @endif>
                <option></option>
                @foreach ($emociones as $emocion)
                <option value="{{$emocion->id}}" @if($emocion->id == $recuerdo->emocion_id) selected @endif>{{$emocion->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row col-sm-4 col-md-4 col-lg-4 align-items-center">
        <label for="categoria" class="form-label col-form-label negrita col-sm-6 col-md-5 col-lg-3">Categoría:</label>
        <div class="col-sm-3 col-md-4 col-lg-5">
            <select onchange="especifiqueCategoria()" style="margin-right: 5px" class="form-select form-select-sm form-control" id="categoria_id" name="categoria_id" @if($show) disabled @endif>
                <option></option>
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
    <label for="localizacion" class="form-label col-form-label negrita">Localización:</label>
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
    <table id="tabla_personas" class="table table-bordered table-striped table-responsive datatable tablaPersonaRecuerdo" style="width: 100%;">
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
        <tbody>
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
                <input type="hidden" value="{{$persona->id}}" name="checkPersona[]">
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