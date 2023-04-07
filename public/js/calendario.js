

document.addEventListener('DOMContentLoaded', function () {
    let user = document.getElementById('user_type').value; //tipo de usuario (1 terapeuta, 2 cuidador)
    let formulario = document.getElementById('formulario');
    var calendarEl = document.getElementById('calendar');
    let idPaciente = document.getElementById('paciente_id').value;

    let url_eventos = "/calendario/" + idPaciente;
    let options = {
        dayHeaderFormat: {
            weekday: 'long'
        },
        fixedWeekCount: false,
        customButtons: {

        },
        locale: 'es',
        noEventsText: 'No hay eventos disponibles',
        eventColor: '#74e4fb',
        firstDay: 1,
        themeSystem: 'bootstrap5',
        initialView: 'dayGridMonth',
        buttonClass: {
            dayGridMonth: 'fc-dayGridMonth-button'
        },
        buttonIcons: {
            add_event: 'calendar-plus',
            prev: 'arrow-left',
            next: 'arrow-right',
        },
        headerToolbar: {
            left: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth,today',


        },
        footerToolbar: {
            center: 'prev,next',
        },

        events: url_eventos,

        dateClick: function (info) {
            formulario.reset();

            //Borra la multimedia del los modales
            $("#sesion-modal #showMultimedia").children().detach();
            $("#actividad-modal #showMultimediaActividad").children().detach();
            $("#tablaMultiActividad").DataTable().clear().draw()


            /*TERAPEUTA****************************************************************/
            if (user === '1') {
                document.getElementById('idSesion').value = "";
                document.getElementById("modalesCalendario").children[0].style.display = "block";
                document.getElementById("modalesCalendario").children[1].style.display = "block";
                formulario.reset();
                /*ACTIVIDAD Y SESION***************************************************/
                document.getElementById('tituloModal').textContent = "Añadir";
                document.getElementById('title').removeAttribute("readonly");
                /**********************************************************************/
                /*ACTIVIDAD**********************************************************+*/
                document.getElementById('start').value = info.dateStr;
                document.getElementById('start').removeAttribute("readonly");
                document.getElementById('obs').removeAttribute("readonly");
                document.getElementById('color').classList.remove('d-none');
                document.getElementById('div-fin').classList.add('d-none');
                document.getElementById('finished').removeAttribute("required");
                document.getElementById('btnGuardar').classList.remove('d-none');
                document.getElementById('btnEliminar').classList.add('d-none');
                document.getElementById('btnModificar').classList.add('d-none');
                document.getElementById('btnFinalizar').classList.add('d-none');
                $("#multiActividadBtn").hide()
                /**********************************************************************/
                /*SESIÓN*************************************************************+*/
                document.getElementById('sesion-modal-tab').removeAttribute("disabled");
                document.getElementById('sesion-modal-tab').classList.remove("active");
                document.getElementById('sesion-modal').classList.remove("show");
                document.getElementById('sesion-modal').classList.remove("active");
                document.getElementById('actividad-modal-tab').removeAttribute("disabled");
                document.getElementById('actividad-modal-tab').classList.add("active");
                document.getElementById('actividad-modal').classList.add("show");
                document.getElementById('actividad-modal').classList.add("active");
                document.getElementById('titulo').value = "";
                document.getElementById('fecha').value = info.dateStr + " 09:00:00";
                document.getElementById('objetivo').value = "";
                document.getElementById('descripcion').value = "";
                var tabla = $("#tabla_recuerdos").dataTable();
                tabla.api().clear().draw();
                document.getElementById('btnGuardarSesion').classList.remove('d-none');
                document.getElementById('btnEliminarSesion').classList.add('d-none');

                /**********************************************************************/
                $('#evento').modal('show');
            }
            /**************************************************************************/
            /*CUIDADOR*****************************************************************/
            /*Un cuidador no puede usar el dateClick***********************************/
            /**************************************************************************/
        },

        eventClick: function (info) {
            formulario.reset();

            /*TERAPEUTA****************************************************************/
            if (user === '1') {
                /*ACTIVIDAD**********************************************************+*/
                if (info.event.extendedProps.tipo === 'a') {
                    document.getElementById("modalesCalendario").children[0].style.display = "block";
                    document.getElementById("modalesCalendario").children[1].style.display = "none";

                    document.getElementById('id').value = info.event.id;
                    document.getElementById('title').value = info.event.title;
                    document.getElementById('start').value = info.event.startStr;
                    document.getElementById('color').value = info.event.backgroundColor;
                    document.getElementById('obs').value = info.event.extendedProps.description;

                    document.getElementById('finished').removeAttribute("required");
                    document.getElementById('finished').setAttribute("readonly", "");
                    document.getElementById('btnGuardar').classList.add('d-none');
                    document.getElementById('btnFinalizar').classList.add('d-none');


                   

                    /*ACTIVIDAD NO FINALIZADA******************************************/
                    if (info.event.extendedProps.finished === null) {
                        document.getElementById('title').removeAttribute("readonly");
                        document.getElementById('start').removeAttribute("readonly");
                        document.getElementById('obs').removeAttribute("readonly");
                        document.getElementById('color').classList.remove('d-none');

                        document.getElementById('div-fin').classList.add('d-none');

                        document.getElementById('btnEliminar').classList.remove('d-none');
                        document.getElementById('btnModificar').classList.remove('d-none');
                    }
                    /*******************************************************************/
                    /*ACTIVIDAD FINALIZADA**********************************************/
                    else {
                        document.getElementById('finished').value = info.event.extendedProps.finished;

                        document.getElementById('title').setAttribute("readonly", "");
                        document.getElementById('start').setAttribute("readonly", "");
                        document.getElementById('obs').setAttribute("readonly", "");
                        document.getElementById('color').classList.add('d-none');

                        document.getElementById('div-fin').classList.remove('d-none');

                        document.getElementById('btnEliminar').classList.add('d-none');
                        document.getElementById('btnModificar').classList.add('d-none');
                    }
                    /********************************************************************/

                    let multimedias = info.event.extendedProps.multimedias
                    let div = $("#showMultimediaActividad")
                    div.children().detach()
                 
                    if (multimedias.length > 0)
                        $("#multiActividadBtn").show()
                    
                    multimedias.forEach(e => {

                        let nombre = e.nombre.slice(0, 20)
                        let ruta = getRuta(e)
                        let img = `<div class="d-flex flex-column align-items-center mb-2" style="width: fit-content;">
                                    <div class="img-wrap">
                                        <a href="${e.fichero}" class="visualizarImagen">
                                            <img style="height: 10em;" src="${ruta}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon imagen">
                                        </a>
                                    </div>
                                    <small>${nombre}</small>
                                </div>`

                        div.append($(img))

                        let table = $("#tablaMultiActividad")

                        let row = $("<tr></tr>")
                        row.append("<td style='display: none'>Hola</td>")
                        row.append(`"<td class='d-flex justify-content-center'>
                                        <div class="d-flex flex-column text-center">
                                            <a href="${e.fichero}"><img style="height: 20em;" src="${ruta}" alt=""></img></a>
                                            <small>${nombre}</small>
                                        </div>
                                    </td>"`)

                        row.append(`<td class="tableActions seleccionar">
                                    <input class="form-check-input check-multimedia" 
                                        data-nombre="${e.nombre}"
                                        data-fichero="${e.fichero}"
                                        type="checkbox" value="${e.id}" name="mult[]" checked>
                                    </td>`)

                        setRow(table.dataTable(), row)

                    })


                }
                /************************************************************************/
                /*SESIÓN***************************************************************+*/
                else {
                   
                    let ficherosExistentes = info.event.extendedProps.multimedias.map(e => e.fichero)
                    $("#modalMultimedia .tableActions input").each((i, e) =>  $(e).prop("checked", ficherosExistentes.includes($(e).data("fichero"))))


                    document.getElementById("modalesCalendario").children[0].style.display = "none";
                    document.getElementById("modalesCalendario").children[1].style.display = "block";

                    document.getElementById('idSesion').value = info.event.id;
                    document.getElementById('fecha').value = info.event.extendedProps.fecha;
                    document.getElementById('titulo').value = info.event.title;
                    console.log(document.getElementById('titulo'));
                    document.getElementById('objetivo').value = info.event.extendedProps.objetivo;
                    document.getElementById('descripcion').value = info.event.extendedProps.descripcion;
                    var tabla = $("#tabla_recuerdos").dataTable();
                    tabla.api().clear();
                    for (let recuerdo of info.event.extendedProps.recuerdos) {
                        let row = $("<tr></tr>");
                        row.append($('<td>' + recuerdo.nombre + '</td>'));
                        row.append($('<td>' + recuerdo.fecha + '</td>'));
                        row.append($('<td>' + recuerdo.etapa.nombre + '</td>'));
                        row.append($('<td>' + recuerdo.categoria.nombre + '</td>'));
                        row.append($('<td>' + recuerdo.estado.nombre + '</td>'));
                        tabla.api().row.add(row).draw()
                    }


                    document.getElementById('btnEliminarSesion').classList.remove('d-none');


                    let div = $("#showMultimedia")
                    div.children().detach()
                    let multimedias = info.event.extendedProps.multimedias
                    

                    multimedias.forEach(e => {

                        let nombre = e.nombre.slice(0, 20)
                        let ruta = getRuta(e)

                        let img = `<div class="d-flex flex-column align-items-center mb-2" style="width: fit-content;">
                                    <div class="img-wrap">
                                        <a href="${e.fichero}" class="visualizarImagen">
                                            <img style="height: 10em;" src="${ruta}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon imagen">
                                        </a>
                                    </div>
                                    <small>${nombre}</small>
                                </div>`

                        div.append($(img))
                        

                    })

                }
                /************************************************************************/
            }
            /**************************************************************************/
            /*CUIDADOR*****************************************************************/
            else {
                document.getElementById('id').value = info.event.id;
                document.getElementById('title').value = info.event.title;
                document.getElementById('start').value = info.event.startStr;
                document.getElementById('color').value = info.event.backgroundColor;
                document.getElementById('obs').value = info.event.extendedProps.description;

                document.getElementById('title').setAttribute("readonly", "");
                document.getElementById('start').setAttribute("readonly", "");
                document.getElementById('color').setAttribute("readonly", "");
                document.getElementById('obs').setAttribute("readonly", "");
                document.getElementById('color').classList.add('d-none');
                document.getElementById("modalesCalendario").children[1].style.display = "none";
                document.getElementById('finished').setAttribute("required", "");
                if (info.event.extendedProps.finished !== null) {
                    document.getElementById('finished').setAttribute("readonly", "");
                    document.getElementById('finished').value = info.event.extendedProps.finished;
                    document.getElementById('btnFinalizar').classList.add('d-none');
                } else {
                    document.getElementById('finished').removeAttribute("readonly");
                    document.getElementById('btnFinalizar').classList.remove('d-none');
                }
                document.getElementById('btnGuardar').classList.add('d-none');
                document.getElementById('btnEliminar').classList.add('d-none');
                document.getElementById('btnModificar').classList.add('d-none');

            }
            /**************************************************************************/
            /*PARA EL SELECTOR DEL MODAL***********************************************/
            /*ACTIVIDAD****************************************************************/
            if (info.event.extendedProps.tipo === 'a') {
                document.getElementById('sesion-modal-tab').setAttribute("disabled", "");
                document.getElementById('sesion-modal-tab').classList.remove("active");
                document.getElementById('sesion-modal').classList.remove("show");
                document.getElementById('sesion-modal').classList.remove("active");
                document.getElementById('actividad-modal-tab').removeAttribute("disabled");
                document.getElementById('actividad-modal-tab').classList.add("active");
                document.getElementById('actividad-modal').classList.add("show");
                document.getElementById('actividad-modal').classList.add("active");
            }
            /**************************************************************************/
            /*SESION********************************************************************/
            else if (info.event.extendedProps.tipo === 's') {
                document.getElementById('sesion-modal-tab').removeAttribute("disabled");
                document.getElementById('sesion-modal-tab').classList.add("active");
                document.getElementById('sesion-modal').classList.add("show");
                document.getElementById('sesion-modal').classList.add("active");
                document.getElementById('actividad-modal-tab').setAttribute("disabled", "");
                document.getElementById('actividad-modal-tab').classList.remove("active");
                document.getElementById('actividad-modal').classList.remove("show");
                document.getElementById('actividad-modal').classList.remove("active");
            }
            /**************************************************************************/
            $('#evento').modal('show');

        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Listado',
        },

        height: 650,
        editable: false,
        resizable: true,
        draggable: false,
        displayEventTime: false,
        selectable: true
    }

    if (user === '1') {
        options.customButtons = {
            add_event: {
                text: '+',
                click: function () {
                    formulario.reset();
                    //formularioEliminar.reset();
                    document.getElementById('tituloModal').textContent = "Añadir";
                    document.getElementById('div-fin').classList.add('d-none');
                    $('#evento').modal('show');
                }
            },
            todo: {
                text: 'Todas',
                click: function () {
                    mostrarTodo();
                    var list = document.getElementsByClassName('fc-todo-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].setAttribute("disabled", "");
                    }
                    list = document.getElementsByClassName('fc-sesiones-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                    list = document.getElementsByClassName('fc-actividades-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                }
            },
            actividades: {
                text: 'Actividades',
                click: function () {
                    mostrarActividades();
                    var list = document.getElementsByClassName('fc-todo-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                    list = document.getElementsByClassName('fc-actividades-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].setAttribute("disabled", "");
                    }
                    list = document.getElementsByClassName('fc-sesiones-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                }
            },
            sesiones: {
                text: 'Sesiones',
                click: function () {
                    mostrarSesiones();
                    var list = document.getElementsByClassName('fc-todo-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                    list = document.getElementsByClassName('fc-actividades-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].removeAttribute("disabled");
                    }
                    list = document.getElementsByClassName('fc-sesiones-button');
                    for (index = 0; index < list.length; ++index) {
                        list[index].setAttribute("disabled", "");
                    }
                }
            }
        };
        options.headerToolbar = {
            left: 'todo,actividades,sesiones',
            center: 'title',
            right: 'add_event,dayGridMonth,dayGridWeek,dayGridDay,listMonth,today',
        };
    }

    var calendar = new FullCalendar.Calendar(calendarEl, options);

    function mostrarTodo() {
        for (let i = 0; i < calendar.getEvents().length; i++) {
            calendar.getEvents()[i].setProp('display', 'auto');
        }
        calendar.render();
    }

    function mostrarActividades() {
        for (let i = 0; i < calendar.getEvents().length; i++) {
            if (calendar.getEvents()[i].extendedProps.tipo !== 'a')
                calendar.getEvents()[i].setProp('display', 'none');
            if (calendar.getEvents()[i].extendedProps.tipo === 'a')
                calendar.getEvents()[i].setProp('display', 'auto');
        }
        calendar.render();
    }

    function mostrarSesiones() {
        for (let i = 0; i < calendar.getEvents().length; i++) {
            if (calendar.getEvents()[i].extendedProps.tipo !== 's')
                calendar.getEvents()[i].setProp('display', 'none');
            if (calendar.getEvents()[i].extendedProps.tipo === 's')
                calendar.getEvents()[i].setProp('display', 'auto');
        }
        calendar.render();
    }

    calendar.render();
});


$("#confirmMultiActividad").on("click", function(event){

    let selected = []
    $("#tablaMultiActividad tbody input").each((i, e) =>{
        let elem = $(e)
        if(elem.prop("checked")){
            selected.push({
                id: Number(elem.prop("value")),
                nombre: elem.data("nombre"),
                fichero: elem.data("fichero")
            })
        }
    })


    $("#multiActividad").modal("hide")

    let div = $("#showMultimediaActividad")
    div.children().detach()

    selected.forEach(e => {
        div.append(getDiv(e))
    });

})






