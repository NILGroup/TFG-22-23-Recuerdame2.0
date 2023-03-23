@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos informe de seguimiento</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/cerrarEvaluacion" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('evaluaciones.listaItems')
        <div>
            <a href="/pacientes/{{$paciente->id}}/evaluaciones"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" name="guardarInformeSeguimiento" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script>

    <script src="/js/escalaEvaluacion.js"></script>
    <script src="/js/informeSeguimiento.js"></script>
    @if (Session::has('created'))
        @php 
            Illuminate\Support\Facades\Session::forget('created');
        @endphp
        <script>
            var action = "Creado"
        </script>
        <script src="/js/successAlert.js"></script>
    @endif
@endpush
