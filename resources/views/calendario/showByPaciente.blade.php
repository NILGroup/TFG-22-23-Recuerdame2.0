@extends('layouts.structure')

@section('content')

<!-- Tu contenido aquí -->
<div class="container">
    <div id="calendar"></div>

    <div class="modal fade" id="evento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="evento" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Actividad</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sesión</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> @include('calendario.registroActividad') </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> @include('calendario.registroSesion') </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('layouts.scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let formulario = document.getElementById('formulario');
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            dayHeaderFormat: {
                weekday: 'long'
            },
            fixedWeekCount: false,
            customButtons: {
                add_event: {
                    text: '+',
                    hint: 'Nueva actividad',
                    click: function() {
                        formulario.reset();
                        document.getElementById('titulo').textContent = "Añadir";
                        $('#evento').modal('show');
                    }
                }
            },
            locales: 'es',
            firstDay: 1,
            initialView: 'dayGridMonth',
            customButtons: {
                todo: {
                    text: 'Todo',
                    click: function() {
                        alert('clicked the todo button!');
                    }
                },
                actividades: {
                    text: 'Actividades',
                    click: function() {
                        alert('clicked the actividades button!');
                    }
                },
                sesiones: {
                    text: 'Sesiones',
                    click: function() {
                        alert('clicked the sesiones button!');
                    }
                }
            },
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'add_event,dayGridMonth,dayGridWeek,dayGridDay,listMonth,today',


            },
            footerToolbar: {
                right: 'todo,actividades,sesiones',
            },

            events: "{{route('calendario.show',$paciente->id)}}",

            dateClick: function(info) {
                formulario.reset();
                document.getElementById('start').value = info.dateStr;
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

                document.getElementById('btnGuardarSesion').classList.remove('d-none');
                document.getElementById('btnEliminarSesion').classList.add('d-none');
                document.getElementById('btnModificarSesion').classList.add('d-none');

                document.getElementById('btnGuardar').classList.remove('d-none');
                document.getElementById('btnEliminar').classList.add('d-none');
                document.getElementById('btnModificar').classList.add('d-none');

                console.log(info);
                $('#evento').modal('show');
            },

            eventClick: function(info) {
                formulario.reset();
                document.getElementById('id').value = info.event.id;
                //Por el momento, si clickamos en ver una actividad se desactiva el botón sesión y viceversa
                //En el futuro, tal vez, hacer que directamente la opción contraria no aparezca
                if (info.event.extendedProps.tipo === 'a') {
                    document.getElementById('profile-tab').setAttribute("disabled", "");
                    document.getElementById('profile-tab').classList.remove("active");
                    document.getElementById('profile').classList.remove("show");
                    document.getElementById('profile').classList.remove("active");
                    document.getElementById('home-tab').removeAttribute("disabled");
                    document.getElementById('home-tab').classList.add("active");
                    document.getElementById('home').classList.add("show");
                    document.getElementById('home').classList.add("active");
                    document.getElementById('title').value = info.event.title;
                    document.getElementById('start').value = info.event.startStr;
                    document.getElementById('color').value = info.event.backgroundColor;
                    document.getElementById('obs').value = info.event.extendedProps.description;

                    document.getElementById('btnGuardar').classList.add('d-none');
                    document.getElementById('btnEliminar').classList.remove('d-none');
                    document.getElementById('btnModificar').classList.remove('d-none');
                } else if (info.event.extendedProps.tipo === 's') {
                    document.getElementById('profile-tab').removeAttribute("disabled");
                    document.getElementById('profile-tab').classList.add("active");
                    document.getElementById('profile').classList.add("show");
                    document.getElementById('profile').classList.add("active");
                    document.getElementById('home-tab').setAttribute("disabled", "");
                    document.getElementById('home-tab').classList.remove("active");
                    document.getElementById('home').classList.remove("show");
                    document.getElementById('home').classList.remove("active");
                    document.getElementById('fecha').value = info.event.extendedProps.fecha;
                    document.getElementById('objetivo').value = info.event.extendedProps.objetivo;
                    document.getElementById('descripcion').value = info.event.extendedProps.descripcion;
                    
                    let tableRef = document.getElementById('divRecuerdos');
                    tableRef.innerHTML = '';
                    
                    for (let recuerdo of info.event.extendedProps.recuerdos) {
                        // Insert a row at the end of the table
                        let newRow = tableRef.insertRow(0);

                        // Insert a cell in the row at index 0
                        let newCell0 = newRow.insertCell(0);
                        let newCell1 = newRow.insertCell(1);
                        let newCell2 = newRow.insertCell(2);
                        let newCell3 = newRow.insertCell(3);
                        let newCell4 = newRow.insertCell(4);
                        let newCell5 = newRow.insertCell(5);
                        let newCell6 = newRow.insertCell(6);

                        // Append a text node to the cell
                        let newText1 = document.createTextNode(recuerdo.nombre);
                        let newText2 = document.createTextNode(recuerdo.fecha);
                        let newText3 = document.createTextNode(recuerdo.etapa.nombre);
                        let newText4 = document.createTextNode(recuerdo.categoria.nombre);
                        let newText5 = document.createTextNode(recuerdo.estado.nombre);
                        let newText6 = document.createTextNode(recuerdo.etiqueta.nombre);

                        // Append a text node to the cell
                        newCell1.appendChild(newText1);
                        newCell2.appendChild(newText2);
                        newCell3.appendChild(newText3);
                        newCell4.appendChild(newText4);
                        newCell5.appendChild(newText5);
                        newCell6.appendChild(newText6);
                    }

                    document.getElementById('btnGuardarSesion').classList.add('d-none');
                    document.getElementById('btnEliminarSesion').classList.remove('d-none');
                    document.getElementById('btnModificarSesion').classList.remove('d-none');
                }


                console.log(info.event.extendedProps);
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
            selectable: true,
            selectHelper: true,
        });

        calendar.render();

    });
</script>

@endpush