<div class="row justify-content-start mb-3">
    <input hidden id="idUser" name="user_id" value="{{$user->id}}" required>
    <input hidden id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required>
    <input type="hidden" name="idSesion" id="idSesion" value="{{$sesion->id}}">
    <input type="hidden" name="respuesta" id="idSesion" value="{{$sesion->respuesta}}">
    <input type="hidden" name="fecha_finalizada" id="idSesion" value="{{$sesion->fecha_finalizada}}">

    <div>
    <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center">
        <label for="fecha" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Fecha: <span class="asterisco">*</span></label>
        <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
            <input max="4000-12-31T23:00:00.0" min="1800-01-01T01:00:00.00" type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}" required>
        </div>
    </div>

    <div class=" d-flex col-lg-4 col-md-6 col-sm-12 mb-2 align-items-center" id="divEtapa">
        <label for="etapa" style="min-width: 70px" class="col-sm-12 col-md-4 col-lg-4 labelShow">Etapa: <span class="asterisco">*</span></label>
        <div class="col-sm-6 col-md-6 col-lg-7" style="min-width: 220px">
            <select class="form-select " name="etapa_id" required>
                @foreach($etapas as $etapa)
                <option value="{{$etapa->id}}" @if($sesion->etapa && $sesion->etapa->id == $etapa->id)
                    selected="selected"
                    @endif
                    >{{$etapa->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="d-flex col-lg-4 col-md-12 col-sm-12 align-items-center">
        <label for="terapeuta" class="form-label labelShow">Terapeuta:</label>
        <label for="terapeuta" class="form-label form-label-sm">{{$user->nombre}} {{$user->apellidos}}</label>
    </div>
</div>



<div class="mb-3">
    <label for="titulo" class="form-label labelShow">Título:<span class="asterisco">*</span></label>
    <input type="text" maxlength="100" class="form-control form-control-sm" id="titulo" name="titulo" value="{{$sesion->titulo}}" required>
</div>

<div class="mb-3">
    <label for="objetivo" class="form-label labelShow">Objetivo:<span class="asterisco">*</span></label>
    <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" required>{{$sesion->objetivo}}</textarea>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label labelShow">Descripción:</label>
    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3">{{$sesion->descripcion}}</textarea>
</div>

<div class="mb-3">
    <label for="acciones" class="form-label labelShow">Secuencia de acciones:</label>
    <textarea class="form-control form-control-sm" id="acciones" name="acciones" rows="3">{{$sesion->acciones}}</textarea>
</div>

<div class="row">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Recuerdos</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="tabla">
        <div class="d-flex justify-content-between upper">
            @if(!$show)
                @include('layouts.tableSearcher')
                <div class="justify-content-end d-flex p-2">
                    <button type="button" id="crearRecuerdo" name="crearRecuerdo" class="btn btn-success me-2 showmodal" @if(!str_contains(url()->current(), 'sesion')) data-show-modal="recuerdosCreator" @else data-bs-toggle="modal" data-bs-target="#recuerdosCreator" @endif><i class="fa-solid fa-plus"></i></button>
                    <button type="button" class="btn btn-success showmodal" @if(!str_contains(url()->current(), 'sesion')) data-show-modal="recuerdosExistentes" @else data-bs-toggle="modal" data-bs-target="#recuerdosExistentes" @endif>Añadir existente</button>
                </div>
            @endif
        </div>
        <table id="tabla_recuerdos" class="table table-bordered table-striped table-responsive datatable">
            <caption>Listado de recuerdos</caption>
            <thead>
                <tr >
                    <th scope="col" class="text-center">Nombre</th>
                    @if (Auth::user()->rol_id == 1)
                        <th scope="col" class="text-center">Etapa</th>
                        <th scope="col" class="text-center">Categoría</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Puntuación</th>
                        <th scope="col" class="text-center">Apto</th>
                    @endif
                    <th class="fit10 actions text-center" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="shadow-sm">

            @foreach($sesion->recuerdos as $recuerdo)
            <tr>

                <td>{{$recuerdo->nombre}}</td>
                @if (Auth::user()->rol_id == 1)
                    <td>{{$recuerdo->etapa->nombre}}</td>

                    @if(!is_null($recuerdo->categoria))
                        <td>{{$recuerdo->categoria->nombre}}</td>
                    @else
                        <td>Sin categoría</td>
                    @endif

                    @if(!is_null($recuerdo->estado))
                        <td>{{$recuerdo->estado->nombre}}</td>
                    @else
                        <td>Sin estado</td>
                    @endif

                    @if(!is_null($recuerdo->puntuacion))
                        @if($recuerdo->puntuacion > 5)
                            <td data-sort="{{ $recuerdo->puntuacion }}">Positivo ({{$recuerdo->puntuacion}})</td>
                        @elseif($recuerdo->puntuacion < 5)
                            <td data-sort="{{ $recuerdo->puntuacion }}">Negativo ({{$recuerdo->puntuacion}})</td>
                        @else
                            <td data-sort="{{ $recuerdo->puntuacion }}">Neutro ({{$recuerdo->puntuacion}})</td>
                        @endif
                    @else
                        <td>Sin puntuación</td>
                    @endif

                    <td class=" text-center"  data-sort="{{ $recuerdo->apto }}">
                        <input class="form-check-input" type="checkbox" name="apto" value="1" id="apto" @if($recuerdo->apto) checked @endif disabled>
                    </td>
                @endif
                <td class="tableActions">
                    <a href="/usuarios/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver información del recuerdo"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="pt-4 pb-2">
    <h5 class="text-muted">Material</h5>
    <hr class="lineaTitulo">
</div>


@if(!$show)
<div class="row " id="add-multi-sesion">
    <div class="justify-content-end d-flex p-2">
        <button type="button" class="btn btn-success me-2 showmodal" @if(str_contains(url()->current(), 'calendario')) data-show-modal="modalMultimedia" @else data-bs-toggle="modal" data-bs-target="#modalMultimedia" @endif>
            Añadir existente
        </button>
    </div>
</div>
@include('sesiones.modals')
@endif

</div>