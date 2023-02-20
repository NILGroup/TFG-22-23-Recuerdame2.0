"use strict"
$(function () {
    $("#guardar").on("click", function (event) {

        const form = document.querySelector("#formulario");

        event.preventDefault();
        event.stopImmediatePropagation();

    
        if (form.checkValidity()){

            var fd = new FormData();
            let email = document.getElementById("email").value;
            console.log(email)
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
                data: fd,
                success: function (data) {
                    console.log(data)
                    if (data) { //si está repetido swal
                        duplicatedAlert(data);
                    } else {
                        form.submit(); //si no está repe lo registramos
                    }
                },
                error: function (data) {
                    console.log(data)
                }
            })
        }

        form.classList.add('was-validated')

        
    });
});

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
            var fd = new FormData();
            let email = document.getElementById("email").value;
            let nombre = document.getElementById("nombre").value;
            let apellidos = document.getElementById("apellidos").value;
            let telefono = document.getElementById("telefono").value;
            let parentesco = document.getElementById("parentesco").value;
            let localidad = document.getElementById("localidad").value;
            let idpaciente = document.getElementById("paciente").value;
            let password = document.getElementById("password").value;
            console.log(email)
            fd.append('email', email);
            fd.append('nombre', nombre);
            fd.append('apellidos', apellidos);
            fd.append('telefono', telefono);
            fd.append('parentesco', parentesco);
            fd.append('localidad', localidad);
            fd.append('paciente', idpaciente); 
            fd.append('password', password);
            fd.append('id', data.id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '/actualizarCuidador',
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                data: fd,
                success: function (data) {
                    Swal.fire('Datos actualizados', '', 'success')
                    console.log(ruta);
                    window.location.href= ruta ;
                },
                error: function (data) {
                    Swal.fire('Error', '', 'error')
                }
            });
        }
    })
}

function repetido() {

    //comprobación de si ya se ha registrado el usuario

}