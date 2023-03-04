<div class="row justify-content-start mb-3">
    <input hidden id="idUser" name="user_id" value="{{$user->id}}" required >
    <input hidden id="idPaciente" name="paciente_id" value="{{$paciente->id}}" required >
    <input type="hidden" name="idSesion" id="idSesion" value="{{$sesion->id}}">
    <input type="hidden" name="respuesta" id="idSesion" value="{{$sesion->respuesta}}">
    <input type="hidden" name="fecha_finalizada" id="idSesion" value="{{$sesion->fecha_finalizada}}">

    <div class=" d-flex col-lg-4 col-md-4 col-sm-12 mb-2 align-items-center">
        <label for="fecha" style="min-width: 65px" class=" labelShow">Fecha: <span class="asterisco">*</span></label>
        <input max="4000-12-31T23:00:00.0" min="1800-01-01T01:00:00.00" type="datetime-local" style="width: fit-content;" class="form-control form-control-sm" id="fecha" name="fecha" value="{{$sesion->fecha}}" required >
    </div>

    <div class=" d-flex col-lg-4 col-md-4 col-sm-12 mb-2 align-items-center" id="divEtapa">
        <label for="etapa" style="min-width: 65px" class=" labelShow">Etapa: <span class="asterisco">*</span></label>
        <select class="form-select " style="width: fit-content;" name="etapa_id" required >
            @foreach($etapas as $etapa)
            <option value="{{$etapa->id}}" @if($sesion->etapa && $sesion->etapa->id == $etapa->id)
                selected="selected"
                @endif
                >{{$etapa->nombre}}</option>
            @endforeach
        </select>
    </div>

    <div class=" d-flex col-lg-4 col-md-6 col-sm-12 align-items-center" >
        <label for="terapeuta" class="form-label labelShow">Terapeuta:</label>
        <label for="terapeuta" class="form-label form-label-sm">{{$user->nombre}} {{$user->apellidos}}</label>
    </div>
</div>

<div class="mb-3">
    <label for="titulo" class="form-label labelShow">Título:<span class="asterisco">*</span></label>
    <input type="text" maxlength="100" class="form-control form-control-sm" id="titulo" name="titulo" value="{{$sesion->titulo}}" required >
</div>

<div class="mb-3">
    <label for="objetivo" class="form-label labelShow">Objetivo:<span class="asterisco">*</span></label>
    <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" required >{{$sesion->objetivo}}</textarea>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label labelShow">Descripción:</label>
    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3" >{{$sesion->descripcion}}</textarea>
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
                    <th scope="col" class="text-center">Etapa</th>
                    <th scope="col" class="text-center">Categoría</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Apto</th>
                    @if($show)
                        <th class="fit10 text-center" scope="col">Acciones</th>
                    @endif
                </tr>
            </thead>

            <tbody class="shadow-sm">
                @foreach ($sesion->recuerdos as $recuerdo)
                <tr>
                    <td>{{$recuerdo->nombre}}</td>
                    <td>
                        @if(isset($recuerdo->etapa)){{$recuerdo->etapa->nombre}}@endif
                    </td>
                    <td>
                        @if(isset($recuerdo->categoria)){{$recuerdo->categoria->nombre}}@endif   
                    </td>
                    <td>
                        @if(isset($recuerdo->estado)){{$recuerdo->estado->nombre}}@endif
                    </td>
                    
                    <td class=" text-center">
                        <input class="form-check-input" type="checkbox" @if($recuerdo->apto) checked @endif disabled>
                    </td>
                    @if($show)
                        <td class="tableActions">
                            <a href="/pacientes/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver datos del recuerdo."></i></a>
                        </td>
                    @endif
                    <input type="hidden" value="{{$recuerdo->id}}" name="recuerdos[]">
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
            <button type="button" class="btn btn-success me-2 showmodal" 
            @if(str_contains(url()->current(), 'calendario')) data-show-modal="modalMultimedia" @else data-bs-toggle="modal" data-bs-target="#modalMultimedia" @endif>
                Añadir existente
            </button>
        </div>
    </div>
    @include('sesiones.modals')
@endif







