@extends('layouts.structure')

@section('content')

<input type="hidden" name="paciente_id" class="form-control form-control-sm" id="paciente_id" value="{{$paciente->id}}" required @if($show) disabled @endif>
<!-- Tu contenido aquí -->
<div class="container">
    <div id="calendar"></div>

    <div class="modal fade" id="evento" data-backdrop="static" data-bs-backdrop="focus" data-keyboard="false" tabindex="-1" aria-labelledby="evento" aria-hidden="false" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
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

@include('sesiones.modals')
@include('recuerdos.modals')

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
    <script src="/js/table.js"></script>
    <script src="/js/calendario.js"></script>
    <script src="/js/recuerdo.js"></script>
    <script src="/js/multiModal.js"></script>
@endpush