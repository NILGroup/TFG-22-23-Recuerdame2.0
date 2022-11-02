<!-- MODALES -->
<div class="modal fade" id="recuerdosCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Crear: Recuerdo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="recuerdosCreatorForm">
                {{csrf_field()}}

                <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-6 col-md-6 col-lg-6">
                        <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre<span class="asterisco">*</span></label>
                        <div class="col-sm-9 col-md-6 col-lg-4">
                            <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row col-sm-6 col-md-6 col-lg-6">
                        <label for="estado" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Estado</label>
                        <div class="col-sm-9 col-md-6 col-lg-4">
                            <select class="form-select form-select-sm" id="idEstado" name="estado_id">
                                <option></option>
                                @foreach ($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="row col-sm-6 col-md-6 col-lg-6">
                        <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                        <div class="col-sm-9 col-md-6 col-lg-4">
                            <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="row col-sm-6 col-md-6 col-lg-6">
                        <label for="etiqueta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etiqueta</label>
                        <div class="col-sm-9 col-md-6 col-lg-4">
                            <select class="form-select form-select-sm" id="idEtiqueta" name="etiqueta_id">
                                <option></option>
                                @foreach ($etiquetas as $etiqueta)
                                <option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row col-sm-12 col-md-12 col-lg-12">
                        <label for="puntuacion" class="form-label col-form-label-sm col-sm-2 col-md-2 col-lg-1">Puntuación</label>

                        <div class="col-md-auto">0</div>
                        <div class="col-sm-5 col-md-5 col-lg-3">
                            <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion">
                        </div>
                        <div class="col">5</div>
                    </div>

                    <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
                    <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>

                <div class="row justify-content-between">
                    <div class="row">
                        <label for="etapa" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Etapa de la vida<span class="asterisco">*</span></label>
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <select class="form-select form-select-sm" id="idEtapa" name="etapa_id" required>
                                @foreach ($etapas as $etapa)
                                <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                                @endforeach

                            </select>
                        </div>

                        <label for="emocion" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Emoción</label>
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <select class="form-select form-select-sm" id="idEmocion" name="emocion_id">
                                <option></option>
                                @foreach ($emociones as $emocion)
                                <option value="{{$emocion->id}}">{{$emocion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="categoria" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Categoría</label>
                        <div class="col-sm-3 col-md-3 col-lg-2">
                            <select class="form-select form-select-sm" id="idCategoria" name="categoria_id">
                                <option></option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="localizacion" class="form-label col-form-label-sm">Localización</label>
                    <textarea maxlength="255" class="form-control form-control-sm" id="localizacion" name="localizacion" rows="3"></textarea>
                </div>

            </div> <!-- Modal body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="crearRecuerdo()">Guardar</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-striped table-responsive">
                    <caption>Listado de recuerdos</caption>
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Etapa</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Etiqueta</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tablaRecuerdosExistentes">
                        <?php $i = 1 ?>
                        @foreach ($recuerdos as $recuerdo)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td>{{$recuerdo->nombre}}</td>
                            <td>{{$recuerdo->fecha}}</td>
                            <td>{{$recuerdo->etapa->nombre}}</td>
                            <td>@if(!is_null($recuerdo->categoria_id)) {{$recuerdo->categoria->nombre}} @endif </td>
                            <td>@if(!is_null($recuerdo->estado_id)) {{$recuerdo->estado->nombre}} @endif </td>
                            <td>@if(!is_null($recuerdo->etiqueta_id)) {{$recuerdo->etiqueta->nombre}} @endif </td>
                            <td id="recuerdosSeleccionados" class="tableActions">
                                <input class="form-check-input" type="checkbox" value="{{$recuerdo->id}}" name="checkRecuerdo[]" id="checkRecuerdo">
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarRecuerdosExistentes(checkRecuerdo);">Guardar</button>
            </div>
        </div>
    </div>
</div>