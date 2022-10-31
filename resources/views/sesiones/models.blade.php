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

<script type="text/javascript">
    function agregarRecuerdosExistentes(r) {
        //console.log(r.length);
        document.getElementById("divRecuerdos").innerHTML = "";
        let allRecuerdos = document.getElementById("tablaRecuerdosExistentes").getElementsByTagName("tr");
        let n = 1;
        for (let i = 0; i < allRecuerdos.length; i++) {

            let rec = allRecuerdos[i].getElementsByTagName("td")
            rec = {
                "id": allRecuerdos[i].getElementsByTagName("th")[0].textContent,
                "nombre": rec[0].textContent,
                "fecha": rec[1].textContent,
                "etapa": rec[2].textContent,
                "categoria": rec[3].textContent,
                "estado": rec[4].textContent,
                "etiqueta": rec[5].textContent,
                "checked": allRecuerdos[i].getElementsByTagName("input")[0].checked,
            }

            if (rec.checked) {
                document.getElementById("divRecuerdos").innerHTML += '<tr>' +
                    '<th scope="row">' + (n++) + '</th>' +
                    '<td>' + rec.nombre + '</td>' +
                    '<td>' + rec.fecha + '</td>' +
                    '<td>' + rec.etapa + '</td>' +
                    '<td>' + rec.categoria + '</td>' +
                    '<td>' + rec.estado + '</td>' +
                    '<td>' + rec.etiqueta + '</td>' +
                    '<input type="hidden" value=' + rec.id + ' name="recuerdos[]">' +
                    '</tr>';

            }
        }
    }
</script>

<script type="text/javascript">
    function crearRecuerdo() {

        const inputValues = document.querySelectorAll('#recuerdosCreatorForm input')
        const selectValues = document.querySelectorAll('#recuerdosCreatorForm select')
        const textValues = document.querySelectorAll('#recuerdosCreatorForm textarea')
        var fd = new FormData();
        fd.append('paciente_id', inputValues[1].value);
        fd.append('nombre', inputValues[2].value);
        fd.append('fecha', inputValues[3].value);
        fd.append('puntuacion', inputValues[4].value);

        fd.append('estado_id', selectValues[0].value);
        fd.append('etiqueta_id', selectValues[1].value);
        fd.append('etapa_id', selectValues[2].value);
        fd.append('emocion_id', selectValues[3].value);
        fd.append('categoria_id', selectValues[4].value);

        fd.append('descripcion', textValues[0].value);
        fd.append('localizacion', textValues[1].value);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: '/storeRecuerdoNoView',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            data: fd,
            success: function(data) {
                reloadRecuerdos(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }

    function reloadRecuerdos(r) {
        let selected = Array.from(document.getElementById("divRecuerdos").getElementsByTagName("input"), function(s) {
            console.log(s.value)
            return s.value
        })

        if (!r.categoria_id) {
            r.categoria = {};
            r.categoria.nombre = " ";
        }
        if (!r.estado_id) {
            r.estado = {};
            r.estado.nombre = " ";
        }
        if (!r.etiqueta_id) {
            r.etiqueta = {};
            r.etiqueta.nombre = " ";
        }

        document.getElementById("tablaRecuerdosExistentes").innerHTML +=
            '<tr>' +
            '<th scope="row">' + r.id + '</th>' +
            '<td>' + r.nombre + '</td>' +
            '<td>' + r.fecha + '</td>' +
            '<td>' + r.etapa.nombre + '</td>' +
            '<td>' + r.categoria.nombre + '</td>' +
            '<td>' + r.estado.nombre + '</td>' +
            '<td>' + r.etiqueta.nombre + '</td>' +
            '<td id="recuerdosSeleccionados" class="tableActions">' +
            '<input class="form-check-input" type="checkbox" value=' + r.id + ' name="checkRecuerdo[]" id="checkRecuerdo" checked>' +
            '</td>' +
            '</tr>';

        document.getElementById("tablaRecuerdosExistentes").getElementsByTagName("input").forEach(c => {
            if (selected.includes(c.value)) {
                c.checked = true;
            }
        })

        document.getElementById("divRecuerdos").innerHTML +=
            '<tr>' +
            '<th scope="row">' + (document.getElementById("divRecuerdos").getElementsByTagName("tr").length + 1) + '</th>' +
            '<td>' + r.nombre + '</td>' +
            '<td>' + r.fecha + '</td>' +
            '<td>' + r.etapa.nombre + '</td>' +
            '<td>' + r.categoria.nombre + '</td>' +
            '<td>' + r.estado.nombre + '</td>' +
            '<td>' + r.etiqueta.nombre + '</td>' +
            '<input type="hidden" value=' + r.id + ' name="recuerdos[]">' +
            '</tr>';
    }
</script>