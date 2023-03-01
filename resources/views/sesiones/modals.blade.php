<div class="modal fade" id="modalMultimedia" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Añadir multimedia existente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <table id="tabla-multimedias-existentes" class="table w-100 table-bordered table-striped table-responsive datatable">
                    <thead>
                        <tr >
                            <th scope="col" style="display: none;">Id</th>
                            <th scope="col text-center">Nombre</th>
                            <th class="fit10" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="shadow-sm">
                        @foreach ($multimedias as $multimedia)
                        <tr>
                            <td style="display: none;">{{$recuerdo->id}}</td>
                            <td>
                                <a href="{{$multimedia->fichero}}">{{$multimedia->nombre}}</a>
                            </td>
                            <td class="tableActions seleccionar">
                                <input class="form-check-input check-multimedia" 
                                    data-nombre ="{{$multimedia->nombre}}" 
                                    data-fichero = "{{$multimedia->fichero}}"
                                    type="checkbox" value="{{$multimedia->id}}" name="mult[]" @if($sesion->multimedias->contains($multimedia)) checked @endif>
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