<!-- MODALES -->
<div class="modal fade" id="personasCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Crear: Personas relacionadas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="modal-body" id="personasCreatorForm">

                @include("personasrelacionadas.listaItems")

            </form> <!-- Modal body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal_guardar">Finalizar</button>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="personasExistentes" tabindex="-1" aria-labelledby="personasExistentesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Personas relacionadas existentes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table id="tablaPersonasExistentes" class="table table-bordered table-striped table-responsive datatable" style="width:100%;">
                    <thead>
                        <tr class="bg-primary">
                            <th style="display: none;" class="text-center">ID</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Apellidos</th>
                            <th class="fit10 text-center" scope="col">Tipo de Relacion</th>
                            <th class="fit5 text-center" scope="col">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                        <tr>
                            <td style="display: none;">{{$persona->id}}</td>
                            <td>{{$persona->nombre}}</td>
                            <td>{{$persona->apellidos}}</td>
                            <td>{{$persona->tiporelacion->nombre}}</td>
                            <td id="personasSeleccionadas" class="tableActions">
                                <input class="form-check-input" type="checkbox" value="{{$persona->id}}" name="checkPersonaExistente[]" id="checkPersonaExistente" @if($recuerdo->personas_relacionadas->contains($persona)) checked @endif>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarPersonas(checkPersonaExistente);">Finalizar</button>
            </div>
        </div>
    </div>
</div>