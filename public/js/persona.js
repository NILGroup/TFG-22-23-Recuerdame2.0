
function especifique(){
    let select = document.getElementById("tiporelacion_id")
    if (select.value === "7"){
        $("#tipo_custom").show()
    }
    else{
        $("#tipo_custom").hide()
    }
}

$("#crearPersona").on("click", function(event){
    let form = $("#personasCreatorForm");
    form.removeClass("was-validated")
    form[0].reset()
})

$("#modal_guardar").on("click", function(event){

    let form = $("#personasCreatorForm")[0]

    if (!form.checkValidity()){
        event.preventDefault()
        event.stopPropagation()
    }
    else{
        CrearPersonas()
    }
    form.classList.add('was-validated')
})




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
    

    fd.append('nombre', inputValues[2].value);
    fd.append('apellidos', inputValues[3].value);
    fd.append('telefono', inputValues[4].value);
    fd.append('ocupacion', inputValues[5].value);
    fd.append('email', inputValues[6].value);
    fd.append('localidad', inputValues[7].value);
    fd.append('tipo_custom', inputValues[8].value);
    if ($(inputValues[9]).prop("checked")){
        fd.append('contacto', inputValues[9].value);
    }
    fd.append('observaciones', document.getElementById("observaciones").value);
    fd.append('tiporelacion_id', rel.value);
    fd.append('paciente_id', inputValues[0].value);

    //console.log([...fd.entries()])

    $("#personasCreator").modal("hide")
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

            let tabla = $("#tabla_personas").dataTable()
            let row = $("<tr></tr>")

            row.append($("<td>" + data["nombre"]  + "</td>"))
            row.append($("<td>" + data["apellidos"] + "</td>"))
            row.append($("<td>" + data["tiporelacion_id"]  + "</td>"))
            row.append($('<td class="tableActions"><a href="/pacientes/{{$paciente->id}}/personas/{{$persona->id}}/'+data["id"] +'><i class="fa-solid fa-eye text-black tableIcon"></i></a></td>'))
            row.append($('<input type="hidden" value=' + data["id"] + ' name="checkPersona[]">'))
            setRow(tabla, row)
                
            reloadPersona(data);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
}

function reloadPersona(p) {

    
    let selected = []
    $("#tabla_personas tbody input").each(function(i, e){
        selected.push($(e).prop("value"))
    })

    let tabla = $("#tablaPersonasExistentes").dataTable()
    let row = $("<tr></tr>")
    row.append($('<td class="row_id">' + p.id + '</td>'))
    row.append($('<td>' + p.nombre + '</td>'))
    row.append($('<td>' + p.apellidos + '</td>'))
    row.append($('<td>' + p.tiporelacion_id + '</td>'))
    row.append($('<td id="personasSeleccionadas" class="tableActions"><input class="form-check-input" type="checkbox" value=' + p.id + ' name="checkPersonaExistente[]" id="checkPersonaExistente" checked>' +
    '</td></tr>'))
    
    setRow(tabla, row)

    $(".row_id").each((i, e) => $(e).hide())
   
    $("#tablasPersonasExistentes input").each((i, e) => {
        if (selected.includes($(e).prop("value"))) {
            $(e).prop("checked", true)
        }
    })


}

function agregarPersonas(p) {

    let tabla = $("#tabla_personas").dataTable()
    tabla.api().rows().remove().draw()

    $("#tablaPersonasExistentes tbody tr").each(function(i, elem){
        let per = $(elem).children()
        
        
        if ($(per[4]).children("input").prop("checked")){
        
            let row = $("<tr></tr>")
            for (let i = 1; i < 4; i++){
                row.append("<td>" + per[i].textContent + "</td>")
            }
            row.append('<input type="hidden" value=' + per[0].textContent + ' name="checkPersona[]">')
            setRow(tabla, row)
        }

    })

}

function setRow(tabla, r){
    tabla.api().row.add(r).draw()
}