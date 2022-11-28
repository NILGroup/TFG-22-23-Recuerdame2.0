<!-- MODALES -->
<div class="modal fade" id="personasCreator" tabindex="-1" aria-labelledby="personasCreatorLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="personasExistentesLabel">Crear: Personas relacionadas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="personasCreatorForm">

                <input type="hidden" name="paciente_id" id="paciente_id" value="{{$paciente->id}}">



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
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="localidad" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Localidad<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="localidad" class="form-control form-control-sm" id="localidad" required @if($show) disabled @endif>
                        </div>
                    </div>
                </div>

                <div class="row form-group justify-content-between">
                    <div class="row col-sm-12 col-md-6 col-lg-5">
                        <label for="tipo" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-6">Tipo relación</label>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <select onchange="especifique()" class="form-select form-select-sm" id="tiporelacion_id" name="tiporelacion_id" required>
                                @foreach ($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                            <input style="display: none;" placeholder="Especifique" type="text" name="tipo_custom" class="form-control form-control-sm" id = "tipo_custom" @if($show) disabled @endif>
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-6 col-lg-7">
                        <label for="contacto" class="form-label col-form-label-sm col-sm-12 col-md-12 col-lg-4">Contacto<span class="asterisco">*</span></label>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <input type="text" name="contacto" class="form-control form-control-sm" id="contacto" required @if($show) disabled @endif>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="observaciones" class="form-label col-form-label-sm">Observaciones</label>
                    <textarea class="form-control form-control-sm" id="observaciones" name="observaciones" rows="3" @if($show) disabled @endif></textarea>
                </div>

            </div> <!-- Modal body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="CrearPersonas()">Guardar</button>
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
                    <tbody id="tablaPersonasExistentes">
                        <?php $i = 1 ?>
                        @foreach ($personas as $persona)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td>{{$persona->nombre}}</td>
                            <td>{{$persona->apellidos}}</td>
                            <td>{{$tipos[$persona->tiporelacion_id]->nombre}}</td>
                            <td id="personasSeleccionadas" class="tableActions">
                                <input class="form-check-input" type="checkbox" value="{{$persona->id}}" name="checkPersonaExistente[]" id="checkPersonaExistente" @if($recuerdo->personas_relacionadas->contains($persona)) checked @endif>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="return agregarPersonas(checkPersonaExistente);">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

        function especifique(){
            let select = document.getElementById("tiporelacion_id")
            if (select.value === "7"){
                $("#tipo_custom").show()
            }
            else{
                $("#tipo_custom").hide()
            }
        }


    function CrearPersonas() {
        /*
        0 Token
        1 Paciente_id
        2 Nombre
        3 Apellidos
        4 Telefono
        5 Ocupaacion
        6 Email
        */

        const inputValues = document.querySelectorAll('#personasCreatorForm input')
        var rel = document.getElementById("tiporelacion_id");
        

        //console.log(inputValues)

        var fd = new FormData();
        fd.append('nombre', inputValues[1].value);
        fd.append('apellidos', inputValues[2].value);
        fd.append('telefono', inputValues[3].value);
        fd.append('ocupacion', inputValues[4].value);
        fd.append('email', inputValues[5].value);
        fd.append('localidad', inputValues[6].value);
        fd.append('tipo_custom', inputValues[7].value);
        fd.append('contacto', inputValues[8].value);
        fd.append('observaciones', document.getElementById("observaciones").value);
        fd.append('tiporelacion_id', rel.value);
        fd.append('paciente_id', inputValues[0].value);

        //console.log([...fd.entries()])

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: '/storePersonaNoView',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            data: fd,
            success: function(data) {
                console.log("ID NUEVA PERSONA:" + data["id"]);
                document.getElementById("divPersonas").innerHTML +=
                    '<tr>' +
                    '<th scope="row">' + (document.getElementById("divPersonas").getElementsByTagName("tr").length + 1) + '</th>' +
                    '<td>' + data["nombre"] + '</td>' +
                    '<td>' + data["apellidos"] + '</td>' +
                    '<td>' + data["tiporelacion_id"] + '</td>' +
                    '<td class="tableActions">'+
                    '<a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}/'+data["id"] +'><i class="fa-solid fa-eye text-black tableIcon"></i></a>'+
                    '</td>'+
                    '<input type="hidden" value=' + data["id"] + ' name="checkPersona[]">' +
                    '</tr>';
                    
                reloadPersona(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        

    }

    function reloadPersona(p) {
        let selected = Array.from(document.getElementById("divPersonas").getElementsByTagName("input"), function(s) {
            console.log(s.value)
            return s.value
        })


        document.getElementById("tablaPersonasExistentes").innerHTML +=
            '<tr>' +
            '<th scope="row">' + p.id + '</th>' +
            '<td>' + p.nombre + '</td>' +
            '<td>' + p.apellidos + '</td>' +
            '<td>' + p.tiporelacion_id + '</td>' +
            '<td id="personasSeleccionadas" class="tableActions">' +
            '<input class="form-check-input" type="checkbox" value=' + p.id + ' name="checkPersonaExistente[]" id="checkPersonaExistente" checked>' +
            '</td>' +
            '</tr>';

        document.getElementById("tablaPersonasExistentes").getElementsByTagName("input").forEach(c => {
            if (selected.includes(c.value)) {
                c.checked = true;
            }
        })
    }
</script>

<script type="text/javascript">
    function agregarPersonas(p) {
        //console.log(p);
        document.getElementById("divPersonas").innerHTML = "";
        let allPersonas = document.getElementById("tablaPersonasExistentes").getElementsByTagName("tr");
        let n = 1;

        for (let i = 0; i < allPersonas.length; i++) {
            let per = allPersonas[i].getElementsByTagName("td");
            per = {
                "id": allPersonas[i].getElementsByTagName("th")[0].textContent,
                "nombre": per[0].textContent,
                "apellidos": per[1].textContent,
                "tiporelacion_id": per[2].textContent,
                "checked": allPersonas[i].getElementsByTagName("input")[0].checked
            }

            if (per.checked) {
                document.getElementById("divPersonas").innerHTML += '<tr>' +
                    '<th scope="row">' + (n++) + '</th>' +
                    '<td>' + per.nombre + '</td>' +
                    '<td>' + per.apellidos + '</td>' +
                    '<td>' + per.tiporelacion_id + '</td>' +
                    '<input type="hidden" value=' + per.id + ' name="checkPersona[]">' +
                    '</tr>';
            }
        }
    }
</script>