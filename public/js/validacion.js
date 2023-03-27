"use strict"

$(function () {


    $(".guardar").each(function (i, e) {
        $(e).on("click", function (event) {
            let form = $(event.target).parents("form")[0]

            if (!form.checkValidity()) {
                event.stopPropagation()
                event.preventDefault()
            }

            form.classList.add('was-validated')
        })
    })

    $(".finalizar").each(function (i, e) {
        $(e).on("click", function (event) {
            var form = $(event.target).parents("form")[0]
            console.log($(form));

            event.stopPropagation()
            event.preventDefault()

            if (form.checkValidity()) {
                var t = $(this).closest("div .tab-pane").attr("id");
                console.log(t);
                event.preventDefault();
                swal.fire({
                    title: '¿Seguro que desea finalizar la actividad?',
                    text: "Si la finaliza, lo hará de forma permanente",
                    icon: "info",
                    showCancelButton: true,
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        confirmButton: 'btn btn-danger me-3',
                        cancelButton: 'btn btn-outline-dark'
                    },
                    buttonsStyling: false
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: '¡Finalizada!',
                                text: 'Se ha finalizado la actividad',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(()=> {
                                $.ajax({
                                    url: '/modificarActividad',
                                    type: 'post',
                                    data: $(form).serialize(),
                                    success: function () {
                                        location.reload();
                                        console.log("Prueba");
                                    },
                                    error: function (e) {
                                        console.log(e);
                                    }
                                });
                            })
                            console.log("Actividad");
                            
                        }
                    });
            } 

            form.classList.add('was-validated');

        })
    })


})