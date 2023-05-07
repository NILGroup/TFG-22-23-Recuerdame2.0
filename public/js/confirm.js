$('.confirm_delete').click(function (event) {
    var form = $(this).closest("form").clone();
    var t = $(this).closest("table.datatable").dataTable();
    var e = $(this).closest("tr");
    var dr = e.clone(true, true)
    event.preventDefault();
    swal.fire({
        title: '¿Seguro que desea eliminar?',
        text: "Si lo elimina, no podrá recuperar los datos",
        icon: "warning",
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
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '¡Eliminado!',
                text: 'Se han borrado los datos',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
            }).then(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: form.attr('action'),
                    processData: false,
                    contentType: false,
                });
                t.api().row(e).remove().draw(); 
                Swal.fire({
                    template:"#borrado",
                    position: 'top-end',
                    backdrop: false,
                    width:"25em",
                    showConfirmButton: false,
                    buttonsStyling:false,
                    timer: 5000,
                    showCancelButton: false,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                })
                .then((result) => {
                    if (result.isDenied) {
                        let id = form.attr('action').split('/');
                        id = id[id.length - 1];

                        let urlR = window.location.href.split('/');
                        console.log(urlR)
                        urlR = urlR[urlR.length - 1] + "/"+ id +"/restore";
                        console.log(urlR)

                        t.api().row.add(dr).draw();
                        
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: urlR,
                            processData: false,
                            contentType: false,
                        });
                    }
                    
                });
            })
        }
    });
});
/*
$('.confirm_delete').click(function deshacer(event) {
    var form =  $(this).closest("form");
    var t = $(this).closest("table.datatable").dataTable();
    var e = $(this).closest("tr");
    var dr = e.clone(true, true);
    event.preventDefault();
    removeFromTable(t, e);

    Swal.fire({
        template:"#borrado",
        position: 'top-end',
        backdrop: false,
        width:"25em",
        showConfirmButton: false,
        buttonsStyling:false,
        timer: 5000,
        showCancelButton: false,
        timerProgressBar: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
      })
      .then((result) => {
        if (!result.isDenied) {
            form.submit()
        }
        else{
            t.api().row.add(dr).draw()
        }
    });
});
*/

/*
*/


//CALENDARIO
$('.confirm_finish').click(function (event) {
    var form = $(this).closest("form");
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
                })
                console.log("Actividad");
                $.ajax({
                    url: '/modificarActividad',
                    type: 'post',
                    data: form.serialize(),
                    success: function () {
                        console.log("Prueba");
                        location.reload();
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });




            }
        });
});
