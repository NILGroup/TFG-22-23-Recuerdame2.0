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