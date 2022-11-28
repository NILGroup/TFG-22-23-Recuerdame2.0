@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <form method="post" action="/actualizarPaciente">
        {{csrf_field()}}
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Datos paciente</h5>
            <hr class="lineaTitulo">
        </div>
        @include('pacientes.listaItems')
        <div class="col-12">
            <button type="submit" value="Guardar" class="btn btn-outline-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}"><button type="button" class="btn btn-primary">Atrás</button></a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
    @include('layouts.scripts')
    <script>
        function especifiqueResidencia(){
            let select = document.getElementById("residencia")
            if (select.value === "5"){
                console.log($("#fecha_inscipcion").show())
            }
            else{
                console.log($("#fecha_inscipcion").hide())
                //$("#fecha_inscripcion").hide()
            }
            if (select.value === "6"){
                $("#residencia_custom").show()
            }
            else{
                $("#residencia_custom").hide()
            }
        }
    </script>
@endpush