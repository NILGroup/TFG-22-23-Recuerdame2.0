<div class="modal fade" id="modalMultimedia" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Añadir multimedia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#existente" type="button" role="tab" aria-controls="home" aria-selected="true">Existente</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#propias" type="button" role="tab" aria-controls="profile" aria-selected="false">Propias</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="existente" role="tabpanel" aria-labelledby="home-tab">
                        <table class="tabla-multimedias-existentes table w-100 table-bordered table-striped table-responsive datatable">
                            <thead>
                                <tr>
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
                                        <input class="form-check-input check-multimedia" data-id="{{$multimedia->id}}" data-nombre="{{$multimedia->nombre}}" data-fichero="{{$multimedia->fichero}}" type="checkbox" value="{{$multimedia->id}}" name="mult[]" @if($recuerdo->multimedias->contains($multimedia)) checked @endif>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="propias" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="tabla-multimedias-existentes table w-100 table-bordered table-striped table-responsive datatable">
                            <thead>
                                <tr>
                                    <th scope="col" style="display: none;">Id</th>
                                    <th scope="col text-center">Nombre</th>
                                    <th class="fit10" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="shadow-sm">
                                @foreach ($recuerdo->multimedias as $multimedia)
                                    @php
                                        $existe = false;
                                        foreach($multimedias as $m){
                                            if ($m->id === $multimedia->id){
                                                $existe = true;
                                            }
                                        }
                                    @endphp

                                    @if (!$existe)

                                    <tr>
                                        <td style="display: none;">{{$recuerdo->id}}</td>
                                        <td>
                                            <a href="{{$multimedia->fichero}}">{{$multimedia->nombre}}</a>
                                        </td>
                                        <td class="tableActions seleccionar">
                                            <input class="form-check-input check-multimedia" data-id="{{$multimedia->id}}" data-nombre="{{$multimedia->nombre}}" data-fichero="{{$multimedia->fichero}}" type="checkbox" value="{{$multimedia->id}}" name="mult[]" @if($recuerdo->multimedias->contains($multimedia)) checked @endif>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary guardar-multimedia">Guardar</button>
            </div>
        </div>
    </div>
</div>