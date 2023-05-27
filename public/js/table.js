/*
*  Columnas excluidas par el filtro de las tablas.
*  El nombre introducido debe ser igual que el introducido en la cabecera.
*/
var noBusqueda = ['Acciones', 'Informe', 'id', 'Id', 'iD', 'ID', 'Apto', 'Asignar'];

var table = $(document).ready(function () {
    /* Inicialización de todas las datatables con clase datatable */
    $('table.datatable').DataTable({
        paging: false,
        info: false,
        sDom:"ltipr",
        "order": [],
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
        /*
        * Una vez inicializadas, se buscan los elementos de la clase searchSelector y searchInput más
        * cercanos y se establecen como los buscadores de las tablas. Para encontrarlo deben encontrarse
        * contenidos en el mismo div que la tabla.
        */
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
                if(!noBusqueda.includes(this.header().textContent))
                    search.children("select").append('<option value="' + i + '">' + this.header().textContent + '</option>');
            })
            $("table.datatable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");   
        },
    });
});