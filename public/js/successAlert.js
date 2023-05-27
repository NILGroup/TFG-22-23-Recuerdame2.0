/* Script utilizado para mostrar el mensaje de creación o modificación satisfactorio.
*  Convendría cambiar el funcionamiento, pasando a usar mensajes flash que llamen a esta
*  función. De esta forma al recargar la página en la que se muestran estos mensajes
*  no deberían volver a mostrarse.
*/
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