$(document).ready(function () {
    $('#tabla').DataTable({
        paging: false,
        info: false,
        language: { 
            search: "_INPUT_",
            searchPlaceholder: " Buscar...",
            emptyTable: "No hay datos disponibles"
        },
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom : "<<'form-control-sm mr-5' f>>"
    });
});

$(document).ready(function () {
    $('#tabla1').DataTable({
        paging: false,
        info: false,
        language: { 
            search: "_INPUT_",
            searchPlaceholder: " Buscar...",
            emptyTable: "No hay datos disponibles"
        },
        responsive: {
            details: {
            type: 'column',
            target: 'tr'
            }
        },
        dom : "<<'form-control-sm mr-5' f>>"
    });

    $('#tabla2').DataTable({
        paging: false,
        info: false,
        language: { 
            search: "_INPUT_",
            searchPlaceholder: " Buscar...",
            emptyTable: "No hay datos disponibles"
        },
        responsive: {
            details: {
            type: 'column',
            target: 'tr'
            }
        },
        dom : "<<'form-control-sm mr-5' f>>"
    });

    $('#tabla3').DataTable({
        paging: false,
        info: false,
        language: { 
            search: "_INPUT_",
            searchPlaceholder: " Buscar...",
            emptyTable: "No hay datos disponibles"
        },
        responsive: {
            details: {
            type: 'column',
            target: 'tr'
            }
        },
        dom : "<<'form-control-sm mr-5' f>>"
    });
});