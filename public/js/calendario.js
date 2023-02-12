document.addEventListener('DOMContentLoaded', function () {
    let user = document.getElementById('user_type').value; //tipo de usuario (1 terapeuta, 2 cuidador)
    let formulario = document.getElementById('formulario');
    var calendarEl = document.getElementById('calendar');

    let url_eventos = "/calendario/" + document.getElementById('paciente_id').value;
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
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth,today',


        },

        events: url_eventos,

        dateClick: function (info) {
            formulario.reset();

            //Cuidador sólo podrá ver actividades.
            //Por tanto, cuando un cuidador haga click en un dia, no hará nada
            if (user === '1') {
                formulario.reset();
                //formularioEliminar.reset();
                document.getElementById('start').value = info.dateStr;
                document.getElementById('fecha').value = info.dateStr + " 09:00:00";
                document.getElementById('objetivo').value = "";
                document.getElementById('descripcion').value = "";
                
                var tabla = $("#tabla_recuerdos").dataTable();
                console.log(tabla);
                tabla.api().clear().draw();
                console.log(tabla);
                document.getElementById('titulo').textContent = "Añadir";
                //TODO como hacerlo para que se visualicen ambos y se elija primero activdad
                document.getElementById('profile-tab').removeAttribute("disabled");
                document.getElementById('profile-tab').classList.remove("active");
                document.getElementById('profile').classList.remove("show");
                document.getElementById('profile').classList.remove("active");
                document.getElementById('home-tab').removeAttribute("disabled");
                document.getElementById('home-tab').classList.add("active");
                document.getElementById('home').classList.add("show");
                document.getElementById('home').classList.add("active");

                document.getElementById('div-fin').classList.add('d-none');

                document.getElementById('btnGuardarSesion').classList.remove('d-none');
                document.getElementById('btnEliminarSesion').classList.add('d-none');
                document.getElementById('btnModificarSesion').classList.add('d-none');

                document.getElementById('btnGuardar').classList.remove('d-none');
                document.getElementById('btnEliminar').classList.add('d-none');
                document.getElementById('btnModificar').classList.add('d-none');

                console.log(info.dateStr + " 09:00:00");
                $('#evento').modal('show');
            }
        },

        eventClick: function (info) {
            formulario.reset();
            //formularioEliminar.reset();
            //document.getElementById('id').value = info.event.id;
            if(user === '1') { //Se trata de un terapeuta
                document.getElementById('finished').removeAttribute("required");
                if(info.event.extendedProps.tipo === 'a' && info.event.extendedProps.finished === null) { //Si se trata de una actividad y no ha sido finalizada...
                    document.getElementById('div-fin').classList.add('d-none');
                } else if (info.event.extendedProps.tipo === 'a' && info.event.extendedProps.finished !== null) { //Si se trata de una actividad y ha sido finalizada...
                    document.getElementById('div-fin').classList.remove('d-none');
                    
                    document.getElementById('finished').setAttribute("readonly", "");
                }
            } else { //Se trata de un cuidador
                document.getElementById('title').setAttribute("readonly", "");
                document.getElementById('start').setAttribute("readonly", "");
                document.getElementById('color').setAttribute("readonly", "");
                document.getElementById('obs').setAttribute("readonly", "");
                document.getElementById("modalesCalendario").children[1].style.display = "none";
                document.getElementById('btnModificar').value = "Finalizar actividad";
                document.getElementById('finished').setAttribute("required", "");
                if (info.event.extendedProps.tipo === 'a' && info.event.extendedProps.finished !== null)
                    document.getElementById('finished').setAttribute("readonly", "");
            }


            if (info.event.extendedProps.tipo === 'a') {
                //Para que solo aparezca la pestaña de Actividad...
                document.getElementById('profile-tab').setAttribute("disabled", "");
                document.getElementById('profile-tab').classList.remove("active");
                document.getElementById('profile').classList.remove("show");
                document.getElementById('profile').classList.remove("active");
                document.getElementById('home-tab').removeAttribute("disabled");
                document.getElementById('home-tab').classList.add("active");
                document.getElementById('home').classList.add("show");
                document.getElementById('home').classList.add("active");

                //Para dejar los botones necesarios
                document.getElementById('btnGuardar').classList.add('d-none');
                if(user === '2') {
                    document.getElementById('btnEliminar').classList.add('d-none');
                    if(info.event.extendedProps.finished === null)
                        document.getElementById('btnModificar').classList.remove('d-none');
                    else
                        document.getElementById('btnModificar').classList.add('d-none');
                } else {
                    document.getElementById('btnEliminar').classList.remove('d-none');
                    document.getElementById('btnModificar').classList.remove('d-none');
                }

                //Para asignar los valores...
                document.getElementById('id').value = info.event.id;
                //document.getElementById('idEliminar').value = info.event.id;
                document.getElementById('title').value = info.event.title;
                document.getElementById('start').value = info.event.startStr;
                document.getElementById('color').value = info.event.backgroundColor;
                document.getElementById('obs').value = info.event.extendedProps.description;
                if(info.event.extendedProps.finished !== null)
                    document.getElementById('finished').value = info.event.extendedProps.finished;

            } else if (info.event.extendedProps.tipo === 's') {
                //Para que solo aparezca la pestaña de Sesión...
                document.getElementById('profile-tab').removeAttribute("disabled");
                document.getElementById('profile-tab').classList.add("active");
                document.getElementById('profile').classList.add("show");
                document.getElementById('profile').classList.add("active");
                document.getElementById('home-tab').setAttribute("disabled", "");
                document.getElementById('home-tab').classList.remove("active");
                document.getElementById('home').classList.remove("show");
                document.getElementById('home').classList.remove("active");

                //Para dejar los botones necesarios...
                document.getElementById('btnGuardarSesion').classList.add('d-none');
                document.getElementById('btnEliminarSesion').classList.remove('d-none');
                document.getElementById('btnModificarSesion').classList.remove('d-none');

                //Para asignar los valores...
                document.getElementById('idSesion').value = info.event.id;
                document.getElementById('fecha').value = info.event.extendedProps.fecha;
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
                    row.append($('<td>' + recuerdo.etiqueta.nombre + '</td>'));
                    tabla.api().row.add(row).draw()
                }
                
            }
            console.log(info.event.extendedProps.fecha);
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
        editable: true,
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
                    document.getElementById('titulo').textContent = "Añadir";
                    document.getElementById('div-fin').classList.add('d-none');
                    $('#evento').modal('show');
                }
            },
            todo: {
                text: 'Todo',
                click: function () {
                    mostrarTodo();
                    pruebas();
                }
            },
            actividades: {
                text: 'Actividades',
                click: function () {
                    mostrarActividades();
                }
            },
            sesiones: {
                text: 'Sesiones',
                click: function () {
                    mostrarSesiones();
                }
            }
        };
        options.headerToolbar = {
            left: 'todo,actividades,sesiones',
            center: 'title',
            right: 'add_event,dayGridMonth,dayGridWeek,dayGridDay,listMonth,today',
        };
        options.footerToolbar = {
            right: 'prev,next',
        }
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

    function pruebas() {
        console.log(user);
    }
    calendar.render();
});