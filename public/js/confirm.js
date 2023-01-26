$('.confirm_delete').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
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
    })
    .then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '¡Eliminado!',
                text: 'Se han borrado los datos',
                icon: 'success',
                timer: 3500,
                showConfirmButton: false,
            })
            form.submit()
        }
    });
});