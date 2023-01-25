function crearRecuerdo() {

    const inputValues = document.querySelectorAll('#recuerdosCreatorForm input')
    const selectValues = document.querySelectorAll('#recuerdosCreatorForm select')
    const textValues = document.querySelectorAll('#recuerdosCreatorForm textarea')
    var fd = new FormData();
    fd.append('paciente_id', inputValues[1].value);
    fd.append('nombre', inputValues[2].value);
    fd.append('fecha', inputValues[3].value);
    fd.append('puntuacion', inputValues[4].value);

    fd.append('estado_id', selectValues[0].value);
    fd.append('etiqueta_id', selectValues[1].value);
    fd.append('etapa_id', selectValues[2].value);
    fd.append('emocion_id', selectValues[3].value);
    fd.append('categoria_id', selectValues[4].value);

    fd.append('descripcion', textValues[0].value);
    fd.append('localizacion', textValues[1].value);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "post",
        url: '/storeRecuerdoNoView',
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        data: fd,
        success: function(data) {
            reloadRecuerdos(data);
        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
}

function reloadRecuerdos(r) {
    let selected = Array.from(document.getElementById("divRecuerdos").getElementsByTagName("input"), function(s) {
        console.log(s.value)
        return s.value
    })

    if (!r.categoria_id) {
        r.categoria = {};
        r.categoria.nombre = " ";
    }
    if (!r.estado_id) {
        r.estado = {};
        r.estado.nombre = " ";
    }
    if (!r.etiqueta_id) {
        r.etiqueta = {};
        r.etiqueta.nombre = " ";
    }

    document.getElementById("tablaRecuerdosExistentes").innerHTML +=
        '<tr>' +
        '<th scope="row">' + r.id + '</th>' +
        '<td>' + r.nombre + '</td>' +
        '<td>' + r.fecha + '</td>' +
        '<td>' + r.etapa.nombre + '</td>' +
        '<td>' + r.categoria.nombre + '</td>' +
        '<td>' + r.estado.nombre + '</td>' +
        '<td>' + r.etiqueta.nombre + '</td>' +
        '<td id="recuerdosSeleccionados" class="tableActions">' +
        '<input class="form-check-input" type="checkbox" value=' + r.id + ' name="checkRecuerdo[]" id="checkRecuerdo" checked>' +
        '</td>' +
        '</tr>';

    document.getElementById("tablaRecuerdosExistentes").getElementsByTagName("input").forEach(c => {
        if (selected.includes(c.value)) {
            c.checked = true;
        }
    })

    document.getElementById("divRecuerdos").innerHTML +=
        '<tr>' +
        '<th scope="row">' + (document.getElementById("divRecuerdos").getElementsByTagName("tr").length + 1) + '</th>' +
        '<td>' + r.nombre + '</td>' +
        '<td>' + r.fecha + '</td>' +
        '<td>' + r.etapa.nombre + '</td>' +
        '<td>' + r.categoria.nombre + '</td>' +
        '<td>' + r.estado.nombre + '</td>' +
        '<td>' + r.etiqueta.nombre + '</td>' +
        '<input type="hidden" value=' + r.id + ' name="recuerdos[]">' +
        '</tr>';
}