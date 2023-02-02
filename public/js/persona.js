
function especifique(){
    let select = document.getElementById("tiporelacion_id")
    if (select.value === "7"){
        $("#tipo_custom").show()
    }
    else{
        $("#tipo_custom").hide()
    }
}


$("#modal_guardar").on("click", function(event){

    let form = $("#personasCreatorForm")[0]
    console.log(form)
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
            document.getElementById("divPersonas").innerHTML +=
                '<tr>' +
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

function agregarPersonas(p) {
    //console.log(p);
    document.getElementById("divPersonas").innerHTML = "";
    let allPersonas = document.getElementById("tablaPersonasExistentes").getElementsByTagName("tr");
    let n = 1;

    for (let i = 0; i < allPersonas.length; i++) {
        let per = allPersonas[i].getElementsByTagName("td");
        per = {
            "nombre": per[0].textContent,
            "apellidos": per[1].textContent,
            "tiporelacion_id": per[2].textContent,
            "checked": allPersonas[i].getElementsByTagName("input")[0].checked
        }

        if (per.checked) {
            document.getElementById("divPersonas").innerHTML += '<tr>' +
                    '<td>' + per.nombre + '</td>' +
                    '<td>' + per.apellidos + '</td>' +
                    '<td>' + per.tiporelacion_id + '</td>' +
                    '<input type="hidden" value=' + per.id + ' name="checkPersona[]">' +
                '</tr>';
        }
    }
}