function actualizaModalRecuerdo(idR){

    borrarDatos()
    
    var fd = new FormData();
    $("#tabla_personas tbody tr").each(function(i, e){
        $(e).detach()
    })
    var tablaAsignados = $("#tabla_personas").dataTable();
    var table = $("#tablaPersonasExistentes").dataTable();
    tablaAsignados.api().rows().remove();
    table.api().rows().remove();
    
    fd.append('id', idR);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: '/getRecuerdo',
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        data: fd,
        success: function(data) {
            var data = JSON.parse(data);
            document.getElementById('recuerdo_id').value = data.id;
            document.getElementById('nombre').value = data.nombre;
            if(data.estado_id)
                document.getElementById('idEstado').getElementsByTagName('option')[data.estado_id].selected = 'selected';
            document.getElementById('fecha').value = data.fecha;
            //document.getElementById('idEtiqueta').getElementsByTagName('option')[data.etiqueta_id].selected = 'selected';
            document.getElementById('puntuacion').value = data.puntuacion;
            document.getElementById('descripcion').value = data.descripcion;
            if(data.etapa_id)
                document.getElementById('idEtapa').getElementsByTagName('option')[data.etapa_id].selected = 'selected';
            if(data.emocion_id)
                document.getElementById('idEmocion').getElementsByTagName('option')[data.emocion_id].selected = 'selected';
            if(data.categoria_id)
                document.getElementById('categoria_id').getElementsByTagName('option')[data.categoria_id].selected = 'selected';

            document.getElementById('localizacion').value = data.localizacion;
            document.getElementById('apto').checked  = data.apto;
            if(data.categoria_id == 7)
                document.getElementById('tipo_custom').value = data.tipo_custom;
            else
                document.getElementById('tipo_custom').value = "";
   
            //setValue();

            data.personasrelacionadas.forEach(p => {
                //console.log(p)
                let row = $("<tr></tr>")
                row.append($('<td style="display: none;" class="row_id">' + p.id + '</td>'))
                row.append($('<td>' + p.nombre + " " + p.apellidos + '</td>'))
                row.append($('<td>' + p.direccion + '</td>'))
                row.append($('<td>' + p.tiporelacion_id + '</td>'))
                let checked = p.related ? "checked":"";
                row.append($('<td id="personasSeleccionadas" class="tableActions"><input class="form-check-input" type="checkbox" value=' + p.id + ' name="checkPersonaExistente[]" id="checkPersonaExistente" ' + checked +'>' +
                '</td></tr>'))
                console.log(row.html())
                setRow(table, row)
                if(checked){
                    let row = $("<tr></tr>")
                    row.append($("<td>" + p.nombre + " " + p.apellidos +"</td>"))
                    row.append($('<td>' + p.direccion + '</td>'))
                    row.append($("<td>" + p.tiporelacion_id  + "</td>"))
                    row.append($('<td><input type="hidden" value=' + p.id + ' name="checkPersona[]"></td>'))
                    setRow(tablaAsignados, row)
                }
            });

        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
}

function borrarDatos(){
    let form = $("#recuerdosCreatorForm");
    form.removeClass("was-validated")
    form[0].reset()

    //Borrar la tabla de las personas

    $("#tabla_personas tbody tr").each(function(i, e){
        $(e).detach()
    })
}


$("#crearRecuerdo").on("click", function(event){
    
   $("#recuerdo_id").prop("value", "")
   borrarDatos()

})



$("#modal_recuerdo_guardar").on("click", function(event){

    let form = $("#recuerdosCreatorForm")[0]
    //console.log(form)
    if (!form.checkValidity()){
        event.preventDefault()
        event.stopPropagation()
    }
    else{
        crearRecuerdo()
    }
    form.classList.add('was-validated')
})



function crearRecuerdo() {

    
    const inputValues = document.querySelectorAll('#recuerdosCreatorForm input')
    const selectValues = document.querySelectorAll('#recuerdosCreatorForm select')
    const textValues = document.querySelectorAll('#recuerdosCreatorForm textarea')

    let ids = []

    $("#tablaPersonasExistentes tbody tr").each(function(i, e){

        let per = $(e).children()
        if ($(per[3]).children("input").prop("checked")){
            ids.push(per[0].textContent)
        }

    })

    var fd = new FormData();
    /*
    console.log(inputValues)
    console.log(selectValues)
    console.log(textValues)
    */

    let recuerdo_id = $("#recuerdo_id").prop("value")

    //recuerdosCreatorForm

    if (recuerdo_id){
        fd.append('id', recuerdo_id)
    }
    
    fd.append('paciente_id', $("#paciente_id").prop("value"));
    fd.append('nombre', $("#nombre").prop("value"));
    fd.append('fecha', $("#recuerdosCreatorForm #fecha").prop("value"));
    fd.append('puntuacion', $("#puntuacion").prop("value"));
    fd.append('apto', Number($("#apto").prop("checked")))

    let tipo_custom = $("#tipo_custom").prop("value")
    if (tipo_custom)
        fd.append("tipo_custom", tipo_custom)


    fd.append('estado_id', $("#recuerdosCreatorForm #idEstado").prop("value"));
    fd.append('etapa_id', $("#recuerdosCreatorForm #idEtapa").prop("value"));
    fd.append('emocion_id', $("#recuerdosCreatorForm #idEmocion").prop("value"));
    fd.append('categoria_id', $("#recuerdosCreatorForm #categoria_id").prop("value"));

    fd.append('descripcion', $("#recuerdosCreatorForm #descripcion").prop("value"));
    fd.append('localizacion', $("#recuerdosCreatorForm #localizacion").prop("value"));

    for (var i = 0; i < ids.length; i++) {
        fd.append('ids_personas[]', ids[i]);
    }



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

 
    $("#recuerdosCreator").modal("hide")
}
function reloadRecuerdos(r) {

    let selected = []
    $("#tabla_recuerdos tbody input").each(function(i, elem){
        selected.push($(elem).prop("value"))
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

    let tabla = $("#tabla").dataTable()
    let rId = $("#recuerdo_id").val()


    let row = $("<tr></tr>")
    //console.log()
    addFields(row, r)
    

    tabla.api().rows( function ( idx, data, node ) {
        return data[0] === rId;
    }).remove()
    setRow(tabla, row)
    
}


function addFields(row, rec){
    checked = rec.apto? "checked" : "";
    row.append($('<td style="display: none;">' + rec.id + '</td>'))
    row.append($('<td>' + rec.nombre + '</td>'))
    row.append($('<td>' + rec.etapa.nombre + '</td>'))
    row.append($('<td>' + rec.categoria.nombre + '</td>'))
    row.append($('<td>' + rec.estado.nombre + '</td>'))
    row.append($('<td>' + rec.etiqueta.nombre + '</td>' ))
    row.append($('<td class=" text-center"><input class="form-check-input" type="checkbox" name="apto" value="1" id="aptoTabla"  '+ checked +' disabled></td>' ))
    row.append($('<td class="tableActions">'+
        '<a onclick="actualizaModalRecuerdo('+ rec.id +')" type="button" id="updateRecuerdo" name="updateRecuerdo" class="showmodal" data-bs-toggle="modal" data-bs-target="#recuerdosCreator"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar este recuerdo"></i></a>' +
    '</td>' ));
}

function setRow(tabla, r){
    tabla.api().row.add(r).draw()
}