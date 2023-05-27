/* Función desechada para un primer intento de filtros */
var expanded = false;
var expandedEtiqueta = false;
var expandedEtapa = false;
var expandedCat = false;

function expandir(expanded, checkboxes) {
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
    return expanded;
}

let array = [];
let arrayEt = [];
let arrayCat = [];
let arrayEtapa = [];

/* Función desechada para un primer intento de filtros */
function onCheck(elementoSeleccionado) {
    var select = document.getElementById(elementoSeleccionado);

    if (select.getAttribute("value") == 0) {
        select.setAttribute("value", 1);

    } else select.setAttribute("value", 0);
}

/* Marcar correctamente las opciones del modal de videos al abrirlo */
function onCheckModal(elementoSeleccionado) {
    var select = document.getElementById(elementoSeleccionado);

    if (select.getAttribute("value") == 0) {
        select.setAttribute("value", 1);
    } else select.setAttribute("value", 0);

    var acceptButton = document.getElementById('modal_video_guardar'); //Botón de mandar modal
    var select1 = document.getElementById('imagenesCheck');
    var select2 = document.getElementById('videosCheck');
    var select3 = document.getElementById('narracionCheck');
    if (select1.getAttribute("value") == 0 && select2.getAttribute("value") == 0 && select3.getAttribute("value") == 0) {
        acceptButton.disabled = true; 
    }else{
        acceptButton.disabled = false;
    }
    
}

/* 
* Añadir las opciones de la historia de vida al modal de los 
* videos para que filtre recuerdos correctamente
*/
function videoModalCreator(){
            document.getElementById('fechaInicioModal').value = document.getElementById('fechaInicio').value;
            document.getElementById('fechaFinModal').value = document.getElementById('fechaFin').value
            document.getElementById('aptoModal').value = document.getElementById('apto').value;
            document.getElementById('noAptoModal').value = document.getElementById('noApto').value;

            $('input[name="seleccionEtapa[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionEtapaModal[]"]').eq(i).prop("checked",$(originalCheck).prop("checked"));
            });
            $('input[name="seleccionCat[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionCatModal[]"]').eq(i).prop("checked",$(originalCheck).prop("checked"));
            });
            $('input[name="seleccionEtiq[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionEtiqModal[]"]').eq(i).prop("checked",$(originalCheck).prop("checked"));
            });
}

