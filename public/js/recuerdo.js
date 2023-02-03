$("#crearRecuerdo").on("click", function(event){
    let form = $("#recuerdosCreatorForm");
    form.removeClass("was-validated")
    form[0].reset()

    //Borrar la tabla de las personas

    $("#divPersonas tr").each(function(i, e){
        $(e).detach()
    })
   


})

$("#modal_recuerdo_guardar").on("click", function(event){

    let form = $("#recuerdosCreatorForm")[0]

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

    let allPersonas = document.getElementById("tablaPersonasExistentes").getElementsByTagName("tr");
    let ids = []


    for (let i = 0; i < allPersonas.length; i++) {
        let per = allPersonas[i].getElementsByTagName("td");
        console.log(per)
        let persona = {
            "id": per[0].textContent,
            "nombre": per[1].textContent,
            "apellidos": per[2].textContent,
            "tiporelacion_id": per[3].textContent,
            "checked": allPersonas[i].getElementsByTagName("input")[0].checked
        }   
        
        
        if (persona["checked"]){
            console.log(persona)
            ids.push(persona["id"]) 
        }
            

    }

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

function agregarRecuerdosExistentes(r) {
   
    let table = $("#tabla_recuerdos").dataTable()

    table.api().rows().remove().draw()

    $("#tablaRecuerdosExistentes tbody tr").each(function(i, elem){

        let rec = $(elem).children()
        let recuerdo = {
            "id": rec[0].textContent,
            "nombre": rec[1].textContent,
            "fecha": rec[2].textContent,
            "etapa": rec[3].textContent,
            "categoria": rec[4].textContent,
            "estado": rec[5].textContent,
            "etiqueta": rec[6].textContent,
            "checked": $(rec[7]).children("input").prop("checked"),
        }

        if (recuerdo.checked){

            let row = $("<tr></tr>")
            row.append($('<td>' + recuerdo.nombre + '</td>'))
            row.append($('<td>' + recuerdo.fecha + '</td>'))
            row.append($('<td>' + recuerdo.etapa + '</td>'))
            row.append($('<td>' + recuerdo.categoria + '</td>'))
            row.append($('<td>' + recuerdo.estado + '</td>'))
            row.append($('<td>' + recuerdo.etiqueta + '</td>'))
            row.append($('<input type="hidden" value=' + recuerdo.id + ' name="recuerdos[]">'))

            table.api().row.add(row).draw()

        }

    })

    
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


    let tabla = $("#tablaRecuerdosExistentes").dataTable()

    let row = $("<tr></tr>")
    row.append($('<td class="id_recuerdo">' + r.id + '</td>'))
    row.append($('<td>' + r.nombre + '</td>'))
    row.append($('<td>' + r.fecha + '</td>'))
    row.append($('<td>' + r.etapa.nombre + '</td>' ))
    row.append($('<td>' + r.categoria.nombre + '</td>'))
    row.append($('<td>' + r.estado.nombre + '</td>'))
    row.append($('<td>' + r.etiqueta.nombre + '</td>'))
    row.append($('<td id="recuerdosSeleccionados" class="tableActions">' +
    '<input class="form-check-input" type="checkbox" value=' + r.id + ' name="checkRecuerdo[]" id="checkRecuerdo" checked>' +
    '</td>'))

    tabla.api().row.add(row).draw()

    $(".id_recuerdo").each(function(i, e){
        $(e).hide()
    })

    $("#tablaRecuerdosExistentes tbody input").each(function(i, e){
        let elem = $(e)
        if (selected.includes(elem.prop("value"))){
            elem.prop("checked", true)
        }
    })

    tabla = $("#tabla_recuerdos").dataTable()

    row = $("<tr></tr>")
    row.append($('<td>' + r.nombre + '</td>'))
    row.append($('<td>' + r.fecha + '</td>'))
    row.append($('<td>' + r.etapa.nombre + '</td>' ))
    row.append($('<td>' + r.categoria.nombre + '</td>'))
    row.append($('<td>' + r.estado.nombre + '</td>'))
    row.append($('<td>' + r.etiqueta.nombre + '</td>' ))
    row.append($('<input type="hidden" value=' + r.id + ' name="recuerdos[]">'))

    tabla.api().row.add(row).draw()
    
}