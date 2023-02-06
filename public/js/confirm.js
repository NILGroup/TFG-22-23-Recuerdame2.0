$('.confirm_delete').click(function(event) {
    var form =  $(this).closest("form");
    var t = $(this).closest("table.datatable").dataTable();
    var r = $(this).closest("td");
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
            t.api().row(r).remove().draw(); 

        }
    });
});
/* TO-DO Revisar para que funcione el deshacer
$('.confirm_delete').click(function(event) {
    var form =  $(this).closest("form");
    var el = $(this);

    event.preventDefault();
    var t = $(this).closest("table.datatable").dataTable();
    var e = $(this).closest("tr");
    var ee = e.clone()
    removeFromTable(t, e);

    const Toast = Swal.fire({
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
            location.reload();
        }
    });
});

function removeFromTable(t, r){
    t.api().row(r).remove().draw(); 
}
*/
