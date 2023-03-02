@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos usuario</h5>
        <hr class="lineaTitulo">
    </div>

    @include('pacientes.foto')

    @if(isset($paciente->multimedia))
    <form class="text-center" action="/borrar_foto_paciente" method="post">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$paciente->id}}">
        <button type="submit" class="btn btn-danger mb-3" id="borrar_foto">Eliminar Foto</button>
    </form> 

    <form method="post" action="/actualizarPaciente">
        {{csrf_field()}}
        @include('pacientes.listaItems')
        <div class="col-12">
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>
    @else

    <form class="dropzone p-0" id="d" method="post" action="/actualizarPaciente">
        {{csrf_field()}}
        
            <div class="dropzone-inner">
                @include('pacientes.listaItems')
                
                <div class="dz-default dz-message dropzone-correct" id="dzp">
                    <div class="container dropzone-container">
                        <img src="/img/upload.png" id="dropzone-img" height="25em" alt="">
                        <h2 id="dropzone-title" class="dropzone-title-correct">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">
                    
                </div>
            </div>
        
        <div class="form-group">
            <a href="/pacientes/"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button id="guardar"  type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Finalizar</button>
        </div>
    </form>


    @endif




</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        var id = document.getElementById("paciente_id").value
        var ruta = "/pacientes/" + id
        var max = 1
        var limit = true
    </script>
    <script src="/js/especificar.js"></script>
    <script src="/js/dropzone.js"></script>
@endpush