<!-- MODALES -->
<div class="modal fade" id="recuerdosCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Crear: Recuerdo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>

            <!-- 
                TRANQUILIDAD. SE QUE ES UN FORM DENTRO DE OTRO PERO ESTE NUNCA SE ENVÍA SOLO SE USA
                PARA LA VALIDACIÓN Y DESPUÉS SE MANDAN LOS DATOS POR AJAX, POR FAVOR QUE NADIE
                LO QUITE :((
            -->
            <form class="modal-body" id="recuerdosCreatorForm">
                @include("recuerdos.listaItems")
            </form> <!-- Modal body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                <button id="modal_recuerdo_guardar" type="button" class="btn btn-primary">Finalizar</button>
            </div>
        </div>
    </div>
</div>

</div>



<div class="modal fade" id="recuerdosExistentes" tabindex="-1" aria-labelledby="recuerdosExistentesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recuerdosExistentesLabel">Recuerdos existentes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>

            <div class="modal-body">
                <table id="tablaRecuerdosExistentes" class="table w-100 table-bordered table-striped table-responsive datatable nowrap">
                    <thead>
                        <tr >
                            <th scope="col" style="display: none;" class="text-center">Id</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Etapa</th>
                            <th scope="col" class="text-center">Categoría</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Apto</th>
                            <th class="fit5 text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="shadow-sm">
                        @foreach ($recuerdos as $recuerdo)
                        <tr>
                            <td style="display: none;">{{$recuerdo->id}}</td>
                            <td>{{$recuerdo->nombre}}</td>
                            <td>{{$recuerdo->etapa->nombre}}</td>
                            <td>@if(!is_null($recuerdo->categoria_id)) {{$recuerdo->categoria->nombre}} @endif </td>
                            <td>@if(!is_null($recuerdo->estado_id)) {{$recuerdo->estado->nombre}} @endif </td>
                            <td class=" text-center">
                                <input class="form-check-input" type="checkbox" @if($recuerdo->apto) checked @endif disabled>
                            </td>
                            <td id="recuerdosSeleccionados" class="tableActions">
                                <input class="form-check-input" type="checkbox" value="{{$recuerdo->id}}" name="checkRecuerdo[]" id="checkRecuerdo" @if($sesion->recuerdos->contains($recuerdo)) checked @endif>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarRecuerdosExistentes(checkRecuerdo);">Finalizar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    
@endpush