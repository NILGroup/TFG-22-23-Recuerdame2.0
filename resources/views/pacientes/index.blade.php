@extends('layouts.structure')

@section('content')
<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de pacientes</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <a href="/pacientes/0/cuidadores/crear"><button type="button"  id="mybutton" class="btn btn-primary btn-registro mx-3">Registro cuidador</button></a>
            <a href="{{route('pacientes.create')}}"><button type="button"  class="btn btn-newpaciente btn-info">Nuevo paciente</i></button></a>
        </div>
    </div>

<div>
    <?php $i = 1;?>
    <table id="tabla" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr class="bg-primary">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Género</th>
                <th scope="col">Edad</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <!--<tbody>-->
        @foreach($pacientes as $paciente)
            <tr class="">
            
                <th scope="row" ><?php echo $i ?></th>
                
                <td><a href="/pacientes/{{$paciente->id}}/sesiones" class="link-primary"> {{$paciente->nombre}}</a></td>
                <td>{{$paciente->apellidos}}</td>
                <td>
                    {{$paciente->genero->nombre}}
                </td>
                <td>
                    {{Carbon\Carbon::parse($paciente['fecha_nacimiento'])->age}} 
                </td>
                <td class="tableActions">
                    <div class="d-inline">
                    
                        <a href="/pacientes/{{$paciente->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="{{route('pacientes.edit',$paciente->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('pacientes.destroy', $paciente->id) }}"  style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="confirmar(event)" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                        <a href="/pacientes/{{$paciente->id}}/asignarTerapeutas"><i class="fa-solid fa-users-line text-success tableIcon"></i></a>
                    </div>
                </td>
                <?php   $i++; ?>
            </tr>
        @endforeach

        <caption>Listado de pacientes</caption>
    </table>
</div>


@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  

    <script>
        function confirmar(e) {
            if (!confirm('¿Seguro que desea eliminar este paciente?')) {
                e.preventDefault();
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                paging: false,
                info: false,
                language: { 
                    search: "_INPUT_",
                    searchPlaceholder: " Buscar...",
                    emptyTable: "No hay datos disponibles"
                },
                responsive: {
                    details: {
                    type: 'column',
                    target: 'tr'
                    }
                },
                dom : "<<'form-control-sm mr-5' f>>"
            });
        });
    </script>
@endpush