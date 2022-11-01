@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Modificar datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>
    <form method="post" action="/editarPersona">
        {{csrf_field()}}
        @include('personasrelacionadas.listaItems')
        
        <div class="col-12">
            <button type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>
  

@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush