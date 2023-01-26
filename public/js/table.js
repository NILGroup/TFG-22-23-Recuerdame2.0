$(document).ready(function () {
    $('table.datatable').DataTable({
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
