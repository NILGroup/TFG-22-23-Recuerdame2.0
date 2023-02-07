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
            //console.log(data.personasrelacionadas)

            document.getElementById('recuerdo_id').value = data.id;
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('idEstado').getElementsByTagName('option')[data.estado_id].selected = 'selected';
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('idEtiqueta').getElementsByTagName('option')[data.etiqueta_id].selected = 'selected';
            document.getElementById('puntuacion').value = data.puntuacion;
            document.getElementById('descripcion').value = data.descripcion;
            document.getElementById('idEtapa').getElementsByTagName('option')[data.etapa_id].selected = 'selected';
            document.getElementById('idEmocion').getElementsByTagName('option')[data.emocion_id].selected = 'selected';
            document.getElementById('categoria_id').getElementsByTagName('option')[data.categoria_id].selected = 'selected';
            document.getElementById('localizacion').value = data.localizacion;
            document.getElementById('apto').checked  = data.apto;
            if(data.categoria_id == 7)
                document.getElementById('tipo_custom').value = data.tipo_custom;
            else
                document.getElementById('tipo_custom').value = "";
   
            setValue();

            data.personasrelacionadas.forEach(p => {
                //console.log(p)
                let row = $("<tr></tr>")
                row.append($('<td style="display: none;" class="row_id">' + p.id + '</td>'))
                row.append($('<td>' + p.nombre + '</td>'))
                row.append($('<td>' + p.apellidos + '</td>'))
                row.append($('<td>' + p.tiporelacion_id + '</td>'))
                let checked = p.related ? "checked":"";
                row.append($('<td id="personasSeleccionadas" class="tableActions"><input class="form-check-input" type="checkbox" value=' + p.id + ' name="checkPersonaExistente[]" id="checkPersonaExistente" ' + checked +'>' +
                '</td></tr>'))
                setRow(table, row)

                if(checked){
                    let row = $("<tr></tr>")
                    row.append($("<td>" + p.nombre  + "</td>"))
                    row.append($("<td>" + p.apellidos + "</td>"))
                    row.append($("<td>" + p.tiporelacion_id  + "</td>"))
                    row.append($('<input type="hidden" value=' + p.id + ' name="checkPersona[]">'))
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
        if ($(per[4]).children("input").prop("checked")){
            ids.push(per[0].textContent)
        }

    })


    var fd = new FormData();

    if (inputValues[2].value){
        fd.append('id', inputValues[2].value)
    }

    console.log(inputValues[5].checked)
  

    if (inputValues[2] != ""){
        fd.append('id', inputValues[2].value)
    }
    
    fd.append('paciente_id', inputValues[1].value);
    fd.append('nombre', inputValues[3].value);
    fd.append('fecha', inputValues[4].value);
    fd.append('apto', inputValues[5].checked);
    fd.append('puntuacion', inputValues[6].value);
    
    if (inputValues[7].value)
        fd.append("tipo_custom", inputValues[7].value)
        
    fd.append('estado_id', selectValues[0].value);
    fd.append('etiqueta_id', selectValues[1].value);
    fd.append('etapa_id', selectValues[2].value);
    fd.append('emocion_id', selectValues[3].value);
    fd.append('categoria_id', selectValues[4].value);

    fd.append('descripcion', textValues[0].value);
    fd.append('localizacion', textValues[1].value);

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
    row.append($('<td style="display: none;">' + rec.id + '</td>'))
    row.append($('<td>' + rec.nombre + '</td>'))
    row.append($('<td>' + rec.fecha + '</td>'))
    row.append($('<td>' + rec.etapa.nombre + '</td>' ))
    row.append($('<td>' + rec.categoria.nombre + '</td>'))
    row.append($('<td>' + rec.estado.nombre + '</td>'))
    row.append($('<td>' + rec.etiqueta.nombre + '</td>' ))
    row.append($('<td class="tableActions">'+
        '<a onclick="actualizaModalRecuerdo('+ rec.id +')" type="button" id="updateRecuerdo" name="updateRecuerdo" class="showmodal" data-bs-toggle="modal" data-bs-target="#recuerdosCreator"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>' +
    '</td>' ));
}

function setRow(tabla, r){
    tabla.api().row.add(r).draw()
}