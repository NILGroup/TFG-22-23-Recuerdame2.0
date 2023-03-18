/*
$('#searcher').each(function () {
    let chosenHeaderText = 'x2',
        headers = $('table tr th'),
        chosenHeader = headers.filter(function(header) {
            return headers[header].innerHTML == chosenHeaderText;
        })
        console.log(headers)
});
*/

var table = $(document).ready(function () {
    $('table.datatable').DataTable({
        paging: false,
        info: false,
        scrollY: '50vh',
        scrollCollapse: true,
        scrollResize: true,
        autoWidth: true,
        scrollX: "100%",
        language: { 
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            emptyTable: " ",
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
            var table = this.api();
            var search = $(this).closest('div.tabla').children("div.upper").children("div.search");
            var sel = $(search).children("select.searchSelector")
                .on('change', function() {
                    let val = $(search).children("input.searchInput").val();
                    let col = $(this).find(":selected").val();
                    if(col == "")
                        table.columns().search('').columns().search(this.value).draw(); //Limpiamos la busqueda y rebuscamos. Si no, no funciona
                    else
                        table.columns().search('').column(col).search(val).draw();
                });
            var inp = $(search).children("input.searchInput")
                .on('keyup', function () {
                    let col = $(this).parent().children("select").find(":selected").val();
                    if(col == "")
                        table.search(this.value).draw();
                    else
                        table.column(col).search(this.value).draw();
                });
            var column = this.api().columns().every(function(i) {
                if(this.header().textContent != "")
                    search.children("select").append('<option value="' + i + '">' + this.header().textContent + '</option>');
            })
        },
    });
});