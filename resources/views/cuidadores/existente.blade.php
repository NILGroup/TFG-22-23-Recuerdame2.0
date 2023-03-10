<div class="modal fade" id="modalCuidador" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Añadir multimedia existente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body tabla">
                <div class="d-flex justify-content-between upper">
                    @include('layouts.tableSearcher')
                </div>
                <table class="tabla-multimedias-existentes table w-100 table-bordered table-striped table-responsive datatable">
                    <thead>
                        <tr class="busqueda">
                            <th class="fit10 text-center" scope="col">Nombre</th>
                            <th class="fit10 text-center" scope="col">Correo electrónico</th>
                            <th class="fit5 text-center" scope="col">Teléfono</th>
                            <th class="fit5 text-center" scope="col">Localidad</th>
                            <th class="fit5 text-center" scope="col">Parentesco</th>
                            <th class="text-center" scope="col">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody class="shadow-sm">
                        @foreach($cuidadoresTerapeuta as $cuidador)
                            <tr>
                                <td><a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"> {{$cuidador->nombre}} {{$cuidador->apellidos}} </a></td>
                                <td>{{$cuidador->email}}</td>
                                <td>{{$cuidador->telefono}}</td>
                                <td>{{$cuidador->localidad}}</td>
                                <td>{{$cuidador->parentesco}}</td>
                                <td id="personasSeleccionadas" class="tableActions">
                                    <input class="form-check-input" type="checkbox" value="{{$cuidador->id}}" name="checkPersonaExistente[]" id="checkPersonaExistente">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary guardar-multimedia">Guardar</button>
            </div>
        </div>
    </div>
</div>