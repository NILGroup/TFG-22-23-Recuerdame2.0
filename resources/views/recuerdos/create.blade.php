@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Crear recuerdo</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/recuerdo" class="dropzone">
        <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

        <div class="row form-group justify-content-between">
            <div class="row col-sm-12 col-md-6 col-lg-5">
                <label for="nombre" class="form-label col-form-label-sm col-sm-3 col-md-2 col-lg-2">Nombre<span class="asterisco">*</span></label>
                <div class="col-sm-9 col-md-6 col-lg-4">
                    <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" maxlength="50" required>
                    {{csrf_field()}}
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
                <div class="col-sm-5 col-md-5 col-lg-3">
                    <input type="range" class="form-range puntuacion" id="puntuacion" name="puntuacion" min="0" max="10" step="1" value="puntuacion">
                </div>
                <label id="valorPuntuacion" class="form-label col-sm-2 col-md-2 col-lg-2"></label>
            </div>
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
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de personas relacionadas</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">

                <!-- Nueva persona relacionada -->
                <button type="button" name="crearPersona" class="btn btn-success btn-sm btn-icon me-2" data-bs-toggle="modal" data-bs-target="#personasCreator"><i class="fa-solid fa-plus"></i></button>



                <!-- Persona existente -->
                <button type="button" name="anadiendoPersona" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#personasExistentes">Añadir existente</button>


            </div>


        </div> <!-- col 12 -->


        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Tipo de relación/parentesco</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="divPersonas">
                    <!-- Lista de las personas relacionadas. Actualizarse con JS-->
                </tbody>
            </table>
        </div>

        <div class="pt-4 pb-2">
            <h5 class="text-muted">Material</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row">
            <div class="col-12 justify-content-end d-flex p-2">
            </div>
        </div>

        <div class="dropzone dropzone-previews dropzone-custom" id="my-awesome-dropzone">
            <div class="dz-message text-muted" data-dz-message>
                <span>Click aquí o arrastrar y soltar</span>
            </div>
        </div>

        <div id="showMultimedia" class="row pb-2">
            <!-- Mostrar las multimedias con JS -->
        </div>

        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary btn-sm">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary btn-sm">Atrás</button></a>
        </div>
    </form>
</div>

<!-- MODALES -->
<div class="modal fade" id="personasCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true">
    <form id="crearPersonaForm">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="personasExistentesLabel">Crear: Personas relacionadas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <input type="hidden" name="paciente_id" id="paciente_id" value="{{Session::get('paciente')['id']}}">

                    {{csrf_field()}}

                    <div class="row form-group justify-content-between">
                        <div class="row col-sm-12 col-md-6 col-lg-5">
                            <label for="nombre" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Nombre<span class="asterisco">*</span></label>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <input type="text" name="nombre" class="form-control form-control-sm" id="nombre" required>

                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-6 col-lg-7">
                            <label for="apellidos" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Apellidos<span class="asterisco">*</span></label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <input type="text" name="apellidos" class="form-control form-control-sm" id="apellidos" required>
                            </div>
                        </div>
                    </div>



                    <div class="row form-group justify-content-between">
                        <div class="row col-sm-12 col-md-6 col-lg-5">
                            <label for="telefono" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Teléfono<span class="asterisco">*</span></label>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <input type="text" name="telefono" class="form-control form-control-sm" id="telefono" required>

                            </div>
                        </div>
                        <div class="row col-sm-12 col-md-6 col-lg-7">
                            <label for="ocupacion" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Ocupación<span class="asterisco">*</span></label>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <input type="text" name="ocupacion" class="form-control form-control-sm" id="ocupacion" required>
                            </div>
                        </div>

                    </div>

                    <div class="row form-group justify-content-between">
                        <div class="row col-sm-12 col-md-6 col-lg-5">
                            <label for="email" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Email<span class="asterisco">*</span></label>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <input type="text" name="email" class="form-control form-control-sm" id="email" required>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group justify-content-between">
                        <div class="row col-sm-12 col-md-6 col-lg-5">
                            <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo relación</label>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <select class="form-select form-select-sm" id="tiporelacion_id" name="tiporelacion_id" required>
                                    <option></option>
                                    @foreach ($tipos as $tipo)

                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- Modal body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="CrearPersonas()">Guardar</button>
                </div>
            </div>
        </div>
    </form>

</div>

<div class="modal fade" id="personasExistentes" tabindex="-1" aria-labelledby="personasExistentesLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personasExistentesLabel">Personas relacionadas existentes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered recuerdameTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Tipo de Relacion</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            @foreach ($prelacionadas as $persona)
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td>{{$persona->nombre}}</td>
                                <td>{{$persona->apellidos}}</td>
                                <td>{{$persona->tiporelacion_id}}</td>
                                <td id="recuerdosSeleccionados" class="tableActions">
                                    <input class="form-check-input" type="checkbox" value="{{$persona->id}}" name="checkPersona[]" id="checkPersona">
                                </td>
                            </tr>
                            <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarPersonas(checkPersona);">Guardar</button>
                </div>
            </div>
        </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
    function CrearPersonas() {
        inputValues = document.getElementById("personasCreator");
        console.log(inputValues);
        /* document.getElementById("divPersonas").innerHTML = "";
        let allPersonas = {
            !!json_encode($prelacionadas);!!
        };

        allPersonas = Object.values(allPersonas);
        let n = 1;
        for (let i = 0; i < p.length; i++) {

            let persR = allPersonas.filter(function(o) { //Para cada persona
                if (o.id == p[i].value)
                    return o;
            })[0];

            if (persR != null && p[i].checked) {
                document.getElementById("divPersonas").innerHTML += '<tr>' +
                    '<th scope="row">' + (n++) + '</th>' +
                    '<td>' + persR.nombre + '</td>' +
                    '<td>' + persR.apellidos + '</td>' +
                    '<td>' + persR.tiporelacion_id + '</td>' +
                    '<input type="hidden" value=' + persR.id + ' name="checkPersona[]">' +
                    '</tr>';

            }
        }
        */
    }
</script>

<script type="text/javascript">
    function agregarPersonas(p) {
        console.log(p);
        document.getElementById("divPersonas").innerHTML = "";
        let allPersonas = {!!json_encode($prelacionadas);!!};

        allPersonas = Object.values(allPersonas);
        let n = 1;
        for (let i = 0; i < p.length; i++) {

            let persR = allPersonas.filter(function(o) { //Para cada persona
                if (o.id == p[i].value)
                    return o;
            })[0];

            if (persR != null && p[i].checked) {
                document.getElementById("divPersonas").innerHTML += '<tr>' +
                    '<th scope="row">' + (n++) + '</th>' +
                    '<td>' + persR.nombre + '</td>' +
                    '<td>' + persR.apellidos + '</td>' +
                    '<td>' + persR.tiporelacion_id + '</td>' +
                    '<input type="hidden" value=' + persR.id + ' name="checkPersona[]">' +
                    '</tr>';

            }
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush