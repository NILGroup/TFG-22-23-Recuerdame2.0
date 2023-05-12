<!-- MODALES -->
<div class="modal fade" id="recuerdosCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Recuerdo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
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
            <table id="tablaRecuerdosExistentes" class="table w-100 table-bordered table-striped table-responsive datatable nowrap">    <caption>Listado de recuerdos</caption>
                    <thead>
                        <tr >
                            <th scope="col" style="display: none;" class="text-center">Id</th>
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

                    @foreach($recuerdos as $recuerdo)
                    <tr>
                        <td style="display: none;">{{$recuerdo->id}}</td>
                        <td><a href="/usuarios/{{$paciente->id}}/recuerdos/{{$recuerdo->id}}">{{$recuerdo->nombre}}</a></td>
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
