$(document).ready(function() {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        text:  action + ' satisfactoriamente',
        backdrop: false,
        width:"20em",
        showConfirmButton: false,
        showCancelButton: false,
        timer: 2500,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
    })
});