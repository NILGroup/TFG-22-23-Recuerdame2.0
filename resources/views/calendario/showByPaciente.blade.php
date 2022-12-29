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

                    console.log(info);
                    $('#evento').modal('show');
                },

                eventClick: function(info) {
                    formulario.reset();
                    document.getElementById('id').value = info.event.id;
                    if (document.getElementById('id').value != info.event.id)
                        document.getElementById('titulo').textContent = "Entra Modificar actividad";
                    document.getElementById('btnGuardar').classList.add('d-none');
                    document.getElementById('btnEliminar').classList.remove('d-none');
                    document.getElementById('btnModificar').classList.remove('d-none');
                    document.getElementById('title').value = info.event.title;
                    document.getElementById('start').value = info.event.startStr;
                    document.getElementById('color').value = info.event.backgroundColor;
                    document.getElementById('obs').value = info.event.extendedProps.description;
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