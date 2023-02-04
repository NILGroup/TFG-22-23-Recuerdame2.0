

$("#crearRecuerdo").on("click", function(event){
    let form = $("#recuerdosCreatorForm");
    form.removeClass("was-validated")
    form[0].reset()

    //Borrar la tabla de las personas

    $("#tabla_personas tbody tr").each(function(i, e){
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

    let ids = []

    $("#tablaPersonasExistentes tbody tr").each(function(i, e){

        let per = $(e).children()

        if ($(per[4]).children("input").prop("checked")){
            ids.push(per[0].textContent)
        }

    })


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

        if ($(rec[7]).children("input").prop("checked")){

            let row = $("<tr></tr>")

            for (let i = 1; i < 7; i++){
                row.append($('<td>' + rec[i].textContent + '</td>'))
            }

            row.append($('<input type="hidden" value=' + rec[0].textContent + ' name="recuerdos[]">'))

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
    console.log(r)

    let tabla = $("#tablaRecuerdosExistentes").dataTable()

    let row = $("<tr></tr>")
    row.append($('<td class="id_recuerdo">' + r.id + '</td>'))

    addFields(row, r)
    
    row.append($('<td id="recuerdosSeleccionados" class="tableActions">' +
    '<input class="form-check-input" type="checkbox" value=' + r.id + ' name="checkRecuerdo[]" id="checkRecuerdo" checked>' +
    '</td>'))

    setRow(tabla, row)

    $(".id_recuerdo").each((i, e) => $(e).hide())

    $("#tablaRecuerdosExistentes tbody input").filter((i, e) => selected.includes($(e).prop("value")))
        .each((i, e) => $(e).prop("checked"),true)


    tabla = $("#tabla_recuerdos").dataTable()

    row = $("<tr></tr>")
    addFields(row, r)
    row.append($('<input type="hidden" value=' + r.id + ' name="recuerdos[]">'))

    setRow(tabla, row)
    
}


function addFields(row, rec){
    row.append($('<td>' + rec.nombre + '</td>'))
    row.append($('<td>' + rec.fecha + '</td>'))
    row.append($('<td>' + rec.etapa.nombre + '</td>' ))
    row.append($('<td>' + rec.categoria.nombre + '</td>'))
    row.append($('<td>' + rec.estado.nombre + '</td>'))
    row.append($('<td>' + rec.etiqueta.nombre + '</td>' ))
}

function setRow(tabla, r){
    tabla.api().row.add(r).draw()
}