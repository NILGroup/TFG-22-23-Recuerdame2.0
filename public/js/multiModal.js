Array.from(document.getElementsByClassName('showmodal')).forEach( (e) => {
    e.addEventListener('click', function(element) {
        element.preventDefault();
        if (e.hasAttribute('data-show-modal')) {
            showModal(e.getAttribute('data-show-modal'));
        }
    }); 
});
// Show modal dialog
function showModal(modal) {
    const mid = document.getElementById(modal);
    let myModal = new bootstrap.Modal(mid);
    myModal.show();
}

$(document).on('click','.accept', function(e){
    $(".modal-fade").modal("hide");
    $(".modal-backdrop").remove();
})