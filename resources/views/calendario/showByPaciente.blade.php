@extends('layouts.structure')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let formulario = document.getElementById('formulario');
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            customButtons: {
                add_event: {
                    text: '+',
                    hint: 'Nueva actividad',
                    click: function() {
                        formulario.reset();
                        document.getElementById('titulo').textContent = "Registro de actividad";
                        $('#evento').modal('show');
                    }
                }
            },
            locales: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'add_event,dayGridMonth,timeGridWeek,timeGridDay,listMonth,today',

            },

            events: "{{route('calendario.show',$idPaciente)}}",

            dateClick: function(info) {
                formulario.reset();
                document.getElementById('start').value = info.dateStr;
                document.getElementById('titulo').textContent = "Registro de actividad";

                console.log(info);
                $('#evento').modal('show');
            },

            eventClick: function(info) {
                formulario.reset();
                document.getElementById('id').value = info.event.id;
                document.getElementById('titulo').textContent = "Modificar actividad";
                document.getElementById('btnGuardar').classList.add('d-none');
                document.getElementById('btnEliminar').classList.remove('d-none');
                document.getElementById('btnModificar').classList.remove('d-none');
                document.getElementById('title').value = info.event.title;
                document.getElementById('start').value = info.event.startStr;
                document.getElementById('color').value = info.event.backgroundColor;
                document.getElementById('obs').value = info.event.extendedProps.description;
                console.log(info);
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

<!-- Tu contenido aquí -->
<div class="container">
    <div class="container">
        <div id="calendar">
        </div>
    </div>

    <div class="modal fade" id="evento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="evento" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formulario" method="post" action="/calendario">

                    {{csrf_field()}}
                    <input type="hidden" class="form-control" id="idPaciente" name="idPaciente" value="{{$idPaciente}}">
                    <input type="hidden" class="form-control" id="id" name="id">

                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" required>
                            <label for="title" class="form-label">Título</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="start" name="start" required>
                            <label for="start" class="form-label">Fecha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="color" class="form-control" id="color" name="color" required>
                            <label for="color" class="form-label">Color</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea maxlength="255" class="form-control form-control-sm" id="obs" name="obs" rows="3" required></textarea>
                            <label for="obs" class="form-label">Observaciones</label>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" formaction="/eliminarActividad" id="btnEliminar" name="btnEliminar" value="Eliminar actividad" class="btn btn-danger btn-sm d-none">
                            <input type="submit" formaction="/modificarActividad" id="btnModificar" name="btnModificar" value="Modificar actividad" class="btn btn-warning btn-sm d-none">
                            <input type="submit" id="btnGuardar" name="btnAccion" value="Registrar" class="btn btn-primary btn-sm">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush