@extends('layouts.structure')

@section('content')

<form action="/guardarSesion" method="POST">
    {{csrf_field()}}
    <div class="container-fluid">
        @include('sesiones.listaItems')
        <!--
        <input hidden id="idPaciente" name="paciente_id" value="{{ $paciente->id }}">
        <input hidden id="idUser" name="user_id" value="{{ $user->id }}">

        <div class="row">
            <div class="row">
                <label for="fecha" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Fecha<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-2">
                    <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" value="" required>
                </div>

                <label for="etapa" class="form-label col-form-label-sm col-sm-2 col-md-12col-lg-1">Etapa<span class="asterisco">*</span></label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <select class="form-select form-select-sm" name="etapa_id" required>
                        <option disabled selected value>Seleccione una etapa</option>
                        @foreach($etapas as $etapa)
                        <option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <label for="terapeuta" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-1">Terapeuta:</label>
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <label for="terapeuta" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-12">{{$user->nombre}} {{$user->apellidos}}</label>
                    <input hidden id="terapeuta_id" name="terapeuta_id" value="{{$user->id}}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="objetivo" class="form-label col-form-label-sm">Objetivo<span class="asterisco">*</span></label>
            <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label col-form-label-sm">Descripción</label>
            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>

        <div>
            <div class="mb-3">
                <label for="barreras" class="form-label col-form-label-sm">Barreras</label>
                <textarea class="form-control form-control-sm" id="barreras" name="barreras" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="facilitadores" class="form-label col-form-label-sm">Facilitadores</label>
                <textarea class="form-control form-control-sm" id="facilitadores" name="facilitadores" rows="3"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="pt-4 pb-2">
                <h5 class="text-muted">Recuerdos</h5>
                <hr class="lineaTitulo">
            </div>

            <div class="col-12 justify-content-end d-flex p-2">
                <button type="button" name="crearRecuerdo" class="btn btn-success btn-sm btn-icon me-2" data-bs-toggle="modal" data-bs-target="#recuerdosCreator"><i class="fa-solid fa-plus"></i></button>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#recuerdosExistentes">Añadir existente</button>
            </div>

            <div>
                <table id="tabla" class="table table-bordered table-striped table-responsive">
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

                    <tbody id="divRecuerdos">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material</h5>
            <hr class="lineaTitulo">
        </div>
        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">

                <a href="#" class="btn btn-success btn-sm">Añadir existente</button></a>
            </div>
        </div>
        <div class="dropzone dropzone-previews dropzone-custom" id="my-awesome-dropzone">
            <div class="dz-message text-muted" data-dz-message>
                <span>Click aquí o arrastrar y soltar</span>
            </div>
        </div>

        <div id="showMultimedia" class="row pb-2"> </div>
        -->

    </div>
    <div>
        <button type="submit" name="guardarSesion" value="Guardar" class="btn btn-outline-primary">Guardar</button>
        <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
    </div>
</form>

@include('sesiones.models')
@include('recuerdos.models')

@endsection

@push('scripts')
    @include('layouts.scripts') 
        
    <script type="text/javascript">
        /*
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
        */
    </script>

    <script type="text/javascript">
        /*
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
        */
    </script>

    <script src="/js/recuerdo.js"></script>
    <script src="/js/multiModal.js"></script>
@endpush