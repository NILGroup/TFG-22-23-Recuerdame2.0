@extends('layouts.structure')

@section('content')

<input type="hidden" name="paciente_id" class="form-control form-control-sm" id="paciente_id" value="{{$paciente->id}}" required >
<input type="hidden" name="user_type" class="form-control form-control-sm" id="user_type" value="{{$user->rol_id}}" required >
<!--<select id="typeSelector">
  <option value="all">Todos</option>
  <option value="a">Actividades</option>
  <option value="s">Sesiones</option>
</select>-->

<!-- Tu contenido aquí -->
<div class="container">
    <div id="calendar"></div>

    <div class="modal fade" id="evento" data-backdrop="static" data-bs-backdrop="focus" data-keyboard="false" tabindex="-1" aria-labelledby="evento" aria-hidden="false" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="tituloModal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="modalesCalendario">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="actividad-modal-tab" data-bs-toggle="tab" data-bs-target="#actividad-modal" type="button" role="tab" aria-controls="actividad-modal" aria-selected="true">Actividad</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sesion-modal-tab" data-bs-toggle="tab" data-bs-target="#sesion-modal" type="button" role="tab" aria-controls="sesion-modal" aria-selected="false">Sesión</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="actividad-modal" role="tabpanel" aria-labelledby="actividad-modal-tab"> @include('calendario.registroActividad') </div>
                        <div class="tab-pane fade" id="sesion-modal" role="tabpanel" aria-labelledby="sesion-modal-tab"> @include('calendario.registroSesion') </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('recuerdos.modals')
@include('personasrelacionadas.modals')

@endsection

@push('styles')
    <link rel="stylesheet" href="/css/calendario.css">
@endpush

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>   -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="/js/libs/dataTables.js"></script>
    <script src="/js/libs/fullcalendar.js"></script>
    <script src="/js/libs/sweetAlert2.js"></script>
    <script src="/js/libs/dropzone.js"></script>

    <script src="/js/table.js"></script>
    <script src="/js/calendario.js"></script>
    <script src="/js/recuerdo.js"></script>
    <script src="/js/multiModal.js"></script>
    <script src="/js/confirm.js"></script>
    <script src="/js/validacion.js"></script>
    <script src="/js/multimediaModal.js"></script>
    
    @if (Session::has('created'))
        <script>
            var action = "{{Session::get('created')}}"
        </script>
        @php 
            Illuminate\Support\Facades\Session::forget('created');
        @endphp
        <script src="/js/successAlert.js"></script>
    @endif

    <script>
        $(document).ready(function() {
           
            $('#calendar .fc-dayGridMonth-button').on("click", function() {
                $('#calendar .fc-dayGridMonth-button').attr("disabled", "");
                $('#calendar .fc-dayGridWeek-button').removeAttr("disabled");
                $('#calendar .fc-dayGridDay-button').removeAttr("disabled");
                $('#calendar .fc-listMonth-button').removeAttr("disabled");
            });
            $('#calendar .fc-dayGridWeek-button').on("click", function() {
                $('#calendar .fc-dayGridMonth-button').removeAttr("disabled");
                $('#calendar .fc-dayGridWeek-button').attr("disabled", "");
                $('#calendar .fc-dayGridDay-button').removeAttr("disabled");
                $('#calendar .fc-listMonth-button').removeAttr("disabled");
            });
            $('#calendar .fc-dayGridDay-button').on("click", function() {
                $('#calendar .fc-dayGridMonth-button').removeAttr("disabled");
                $('#calendar .fc-dayGridWeek-button').removeAttr("disabled");
                $('#calendar .fc-dayGridDay-button').attr("disabled", "");
                $('#calendar .fc-listMonth-button').removeAttr("disabled");
            });
            $('#calendar .fc-listMonth-button').on("click", function() {
                $('#calendar .fc-dayGridMonth-button').removeAttr("disabled");
                $('#calendar .fc-dayGridWeek-button').removeAttr("disabled");
                $('#calendar .fc-dayGridDay-button').removeAttr("disabled");
                $('#calendar .fc-listMonth-button').attr("disabled", "");
            });
            $('#calendar .fc-dayGridMonth-button').click();
            $('#calendar .fc-todo-button').click();
        }) 

        
        let id = $("#paciente_id").prop("value")

        let dropzone_config = [{
            form_id : "#sesion-modal #formulario",
            submit_id: "#btnGuardarSesion",
            ruta: "/pacientes/" + id + "/calendario"
        }, 
        {
            form_id : "#actividad-modal #formulario",
            submit_id: ["#btnGuardar", "#btnModificar"],
            ruta: "/pacientes/" + id + "/calendario"
        }
    ]
     
    </script>
    <script src="/js/dropzone.js"></script>
@endpush