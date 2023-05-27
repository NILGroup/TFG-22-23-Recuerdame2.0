/* Funciones para el correcto funcionamiento de varios modales abiertos a la vez */

Array.from(document.getElementsByClassName('showmodal')).forEach( (e) => {
    e.addEventListener('click', function(element) {
        element.preventDefault();
        if (e.hasAttribute('data-show-modal')) {
            showModal(e.getAttribute('data-show-modal'));
        }
    }); 
});

function showModal(modal) {
    const mid = document.getElementById(modal);
    let myModal = new bootstrap.Modal(mid);
    myModal.show();
}

$(document).on('show.bs.modal', '.modal', function () {
    if ($(".modal-backdrop").length > -1) {
        $(".modal-backdrop").not(':first').remove();
    }
});