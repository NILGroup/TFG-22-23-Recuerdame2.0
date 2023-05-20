@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Editar Diagnóstico</h5>
        <hr class="lineaTitulo">
    </div>

    <form action="/modificarDiagnostico" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('diagnostico.listaItems')
        <div>
            <a href="/usuarios/{{$paciente->id}}/diagnostico"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" name="guardarInformeSeguimiento" value="Guardar" class="btn btn-outline-primary guardar">Finalizar</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script> -->
    <script src="/js/libs/touchSpin.js"></script>
    <script src="/js/validacion.js"></script>
    <script src="/js/evaluacion.js"></script>
@endpush