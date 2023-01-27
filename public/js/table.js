$('table.datatable thead tr.searcher th').each(function () {
    console.log("init")
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Buscar por ' + title + '" />');
});
var tabla = $(document).ready(function () {
    $('table.datatable').DataTable({
        paging: false,
        info: false,
        language: { 
            search: "_INPUT_",
            searchPlaceholder: " Buscar...",
            emptyTable: "No hay datos disponibles",
            zeroRecords: "No se han encontrado coincidencias",
        },
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        "sDom":"ltipr",
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) { 
                // On every keypress in this input
                $('input', $('.searcher th').eq($(api.column(colIdx).header()).index())).off('keyup change').on('change', function (e) {
                    // Get the search value
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})';

                    // Search the column for that value
                    api.column(colIdx).search(
                        this.value != ''
                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                            : '',
                        this.value != '',
                        this.value == ''
                    ).draw();
                })
                .on('keyup', function (e) {
                    e.stopPropagation();
                    $(this).trigger('change');
                });
            });
        },
    });
});