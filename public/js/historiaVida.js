//multiple seleccion con checkbox en generar Historia de vida
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


function onCheck(elementoSeleccionado) {
    var select = document.getElementById(elementoSeleccionado);

    if (select.getAttribute("value") == 0) {
        select.setAttribute("value", 1);

    } else select.setAttribute("value", 0);
}


function onCheckModal(elementoSeleccionado) {
    var select = document.getElementById(elementoSeleccionado);

    if (select.getAttribute("value") == 0) {
        select.setAttribute("value", 1);

    } else select.setAttribute("value", 0);


    var acceptButton = document.getElementById('modal_video_guardar');
    if (select.getAttribute("value") == 0) {
        if(elementoSeleccionado == 'imagenesCheck'){
            var select2 = document.getElementById('videosCheck');
            if (select2.getAttribute("value") == 0) {
                acceptButton.disabled = true;
            }else{
                acceptButton.disabled = false;
            }
            
        }else{
            var select2 = document.getElementById('imagenesCheck');
            if (select2.getAttribute("value") == 0) {
                acceptButton.disabled = true;
            }else{
                acceptButton.disabled = false;
            }
        }    
    }else{
        acceptButton.disabled = false;
    }
    
}


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

