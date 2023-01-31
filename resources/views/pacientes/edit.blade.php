@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Datos paciente</h5>
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
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
    @else

    <form class="dropzone p-0" style="border:none !important; background-color: #00000000;" id="d" method="post" action="/actualizarPaciente">
        {{csrf_field()}}
        
            <div style="padding: 20px;">
                @include('pacientes.listaItems')
                
                <div style="border: 1px solid #868e96;" class="dz-default dz-message" id="dzp">
                    <div class="container" style="height: 10em;">
                        <h2 style="color: #868e96;">Arrastre sus archivos</h1>
                    </div>
                </div>
                <div class="dropzone-previews">
                    
                </div>
            </div>
        
        <div class="form-group">
            <button id="guardar"  type="submit" name="guardar" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="/pacientes/"><button type="button" class="btn btn-primary">Atrás</button></a>
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
    </script>
    <script src="/js/especificar.js"></script>
    <script src="/js/dropzone.js"></script>
@endpush