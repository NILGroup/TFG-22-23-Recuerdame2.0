"use strict"

$("#guardar").on("click", function(event){

    event.stopPropagation()
    event.preventDefault()

    

    const form = document.getElementById("d")

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
                if (data) { //si está repetido swal
                    duplicatedAlert(data);
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
    let dropzone = $("#d").prop("dropzone")
    if (dropzone.getQueuedFiles().length > 0) {
        dropzone.processQueue();
    }
    else {
        dropzone._uploadData([{upload: {filename: ''}}],[{filename: '', name: '', data: new Blob()}]);
    }
}


function duplicatedAlert(data) {
    console.log("alerta")
    Swal.fire({
        title: 'Este correo ya está registrado',
        text: '¿Desea actualizar los datos del usuario?',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Guardar cambios',

    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            $("#id").prop("value", data.id)
            submitDropzone()

        }
            

    })
}


