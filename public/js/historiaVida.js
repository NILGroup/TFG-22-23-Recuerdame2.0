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

function videoModalCreator(){


            document.getElementById('fechaInicioModal').value = document.getElementById('fechaInicio').value;
            document.getElementById('fechaFinModal').value = document.getElementById('fechaFin').value
            document.getElementById('aptoModal').value = document.getElementById('aptoModal').value;
            document.getElementById('noAptoModal').value = document.getElementById('noAptoModal').value;

            $('input[name="seleccionEtapa[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionEtapaModal[]"]').eq(i).prop("check",$(originalCheck).prop("checked"));
            });
            $('input[name="seleccionCat[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionCatModal[]"]').eq(i).prop("check",$(originalCheck).prop("checked"));
            });
            $('input[name="seleccionEtiq[]"]').each(function(i,originalCheck) {
                $('input[name="seleccionEtiqModal[]"]').eq(i).prop("check",$(originalCheck).prop("checked"));
            });
}

