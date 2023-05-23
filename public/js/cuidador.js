$("#guardar").on("click", function(event){
    event.stopPropagation()
    event.preventDefault()
    var form = document.getElementById("d")

    if (form.checkValidity()){

        var fd = new FormData();
        let email = document.getElementById("email").value;

        fd.append('email', email);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: '/repeatedCuidador',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            async: false,
            data: fd,
            success: function (data) {
                console.log(data)
                if (data && $("#id").prop("value") != data.id) { 
                    Swal.fire({
                        title: 'Este correo ya está registrado',
                        icon: "error",
                    })
                }
                else{
                    submitDropzone()
                }
            },
            error: function (data) {
                console.log(data)
            }
        })

    }

    form.classList.add('was-validated')

    
})

function submitDropzone(){

    if (send_dropzone){
        let dropzone = $("#d").prop("dropzone")
        if (dropzone.getQueuedFiles().length > 0) {
            dropzone.processQueue();
        }
        else {
            dropzone._uploadData([{upload: {filename: ''}}],[{filename: '', name: '', data: new Blob()}]);
        }
    }
    else{
        document.getElementById("d").submit()
    }
}

function duplicatedAlert(data) {
    console.log("alerta")
    Swal.fire({
        title: 'Este correo ya está registrado',
        text: '¿Desea actualizar los datos del usuario?',
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Guardar cambios',

    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            let idOriginal = $("#id").prop("value")
            ruta = "/usuarios/" + id + "/cuidadores/" + data.id;
            
            $("#id").prop("value", data.id)
            submitDropzone()

            if (idOriginal){

                var fdn = new FormData();
                console.log(idOriginal)
                fdn.append('id', idOriginal)
                fdn.append('idCurrent', data.id)

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $.ajax({
                    type: "post",
                    url: '/borrar_cuidador',
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    async: false,
                    data: fdn,
                    success: function (data) {
                        
                    },
                    error: function (data) {
                        console.log(data)
                    }
                })
            }
        }
    })
}

$("#agregarCuidador").on("click", function(event){

    event.stopPropagation()
    event.preventDefault()

    let tabla = $("#tabla-cuidadores").dataTable()
    tabla.api().rows().remove().draw()

    $("#tabla-cuidadores-existentes tbody tr").each(function(i, elem){
        let per = $(elem).children()
        if ($(per[6]).children("input").prop("checked")){
            let row = $("<tr></tr>")
            row.append("<td><a href='/usuarios/"+$('#paciente_id').prop("value")+"/cuidadores/"+ per[0].textContent +"'> "+ per[1].textContent +" </a></td>")
            row.append("<td>" + per[2].textContent + "</td>")
            row.append("<td>" + per[3].textContent + "</td>")
            row.append("<td>" + per[4].textContent + "</td>")
            row.append("<td>" + per[5].textContent + "</td>")
            row.append('<td class="tableActions"> '+
                '<a href="/usuarios/'+$('#paciente_id').prop("value")+'/cuidadores/'+per[0].textContent+'"><i class="fa-solid fa-eye text-black tableIcon" data-toggle="tooltip" data-placement="top" title="Ver los datos del cuidador"></i></a>' +
                '<a href="/usuarios/'+$('#paciente_id').prop("value")+'/cuidadores/'+per[0].textContent+'/editar"><i class="fa-solid fa-pencil text-primary tableIcon" data-toggle="tooltip" data-placement="top" title="Modificar cuidador"></i></a>'+
                '<form method="post" action="/cuidadores/' + per[0].textContent + '" style="display:inline!important;">'+
                    '<input name="_token" value="'+csrf_js_var+'" type="hidden">' +
                    '<input type="hidden" name="_method" value="DELETE">'+
                    '<button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon" data-toggle="tooltip" data-placement="top" data-bs-original-title="Eliminar cuidador"></i></button>'+
                '</form>'+
            '</td>')
            setRow(tabla, row)
        }
    })
    var form = $(this).closest("form");
    console.log(form.serializeArray())
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/reasignarCuidadores",
        data: form.serialize(),
        error: function (data) {
            console.log(data)
        }
    })
})

function setRow(tabla, r){
    tabla.api().row.add(r).draw()
}

$(document).ready(function() {
    // Seleccionar los campos y agregar un evento keyup
    $("#telefono, #email").on("keyup", function() {
      // Verificar si el valor de cualquier campo es no vacío
      var telefonoVacio = $("#telefono").val() == "";
      var emailVacio = $("#email").val() == "";
      // Actualizar el atributo required en ambos campos
      $("#telefono").prop("required", telefonoVacio && emailVacio);
      $("#email").prop("required", telefonoVacio && emailVacio);
    });
});
  
  
  
  