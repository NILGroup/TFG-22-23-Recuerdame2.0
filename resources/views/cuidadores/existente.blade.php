
<form id="existenteCuidadorForm" method="post" action="/reasignarCuidadores">
    <input type="hidden" name="id" value="{{$paciente->id}}">
    <div class="modal fade" id="cuidadorExistente" tabindex="-1" aria-labelledby="cuidadorExistenteLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cuidadorExistenteLabel">Personas cuidadoras existentes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body tabla">
                    <div class="d-flex justify-content-between upper">
                        @include('layouts.tableSearcher')
                    </div>
                    <table id="tabla-cuidadores-existentes" class="table w-100 table-bordered table-striped table-responsive datatable">
                        <thead>
                            <tr class="busqueda">
                                <th style="hidden" class="fit10 text-center" scope="col">ID</th>
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
                                    <td>{{$cuidador->id}}</td>
                                    <td><a href="/pacientes/{{$paciente->id}}/cuidadores/{{$cuidador->id}}"> {{$cuidador->nombre}} {{$cuidador->apellidos}} </a></td>
                                    <td>{{$cuidador->email}}</td>
                                    <td>{{$cuidador->telefono}}</td>
                                    <td>{{$cuidador->localidad}}</td>
                                    <td>{{$cuidador->parentesco}}</td>
                                    <td id="personasSeleccionadas" class="tableActions">
                                        <input class="form-check-input" type="checkbox" value="{{$cuidador->id}}" name="checkCuidador[]" id="checkCuidador" @if($paciente->users->contains($cuidador)) checked @endif>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="agregarCuidador" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
</form>
