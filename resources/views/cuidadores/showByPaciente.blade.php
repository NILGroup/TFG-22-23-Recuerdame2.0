@extends('layouts.structure')

@section('content')
<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Lista cuidadores</h5>
        <hr class="lineaTitulo">
    </div>
    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <a href="/pacientes/{{$paciente->id}}/cuidadores/crear"><button type="button"  id="mybutton" class="btn btn-primary btn-registro mx-3">Registro cuidador</button></a>
        </div>
    </div>
    <div>
        <table id="tabla" class="table table-bordered table-striped table-responsive">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Localidad</th>
                    <th scope="col">Grado de parentesco</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($cuidadores as $cuidador)
                <tr>
                    <th scope="row"><?php echo $i ?></th>

                    <td>{{$cuidador->nombre}}</td>
                    <td>{{$cuidador->apellidos}}</td>
                    <td>{{$cuidador->email}}</td>
                    <td>{{$cuidador->telefono}}</td>
                    <td>{{$cuidador->localidad}}</td>
                    <td>{{$cuidador->parentesco}}</td>
                    <td class="tableActions">
                        <form method="post" action="{{ route('cuidadores.destroy', $cuidador->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $i++; ?>

                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
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