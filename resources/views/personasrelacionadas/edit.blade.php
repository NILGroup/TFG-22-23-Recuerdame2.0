@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Modificar datos persona relacionada</h5>
        <hr class="lineaTitulo">
    </div>

    @include('personasrelacionadas.foto')
    @if (isset($persona->multimedia))
    <form class="text-center" action="/borrarFoto" method="post">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$persona->id}}">
        <button type="submit" class="btn btn-danger mb-3" id="borrar_foto">Eliminar Foto</button>
    </form> 
    @endif

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
    <script src="/js/especificar.js"></script>
    <script>
        

    </script>
@endpush