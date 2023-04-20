@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Resumen generado</h5>
        <hr class="lineaTitulo">
    </div>
    
    <form class="dropzone p-0" id="d" method="post" action="/guardarResumen">
            {{csrf_field()}}
            <div class="dropzone-inner">
                    @include('resumenes.listaItems')
            </div>
    
        <div>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" id="guardar" name="guardarResumen" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts') 
@endpush