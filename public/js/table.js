$('table.datatable thead').each(function () {
    var searcher = $(this).clone();
    $(searcher).children().removeClass();
    $(searcher).children().children().each(function () {
        var title = $(this).text().toLocaleLowerCase();
        if(!$(this).html() == "")
            $(this).html('<input type="text" class="form-control-sm search" style="border-style:hidden!important; width: 100%" placeholder="Buscar por ' + title + '" />');
    })
    $(this).prepend(searcher.html());
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