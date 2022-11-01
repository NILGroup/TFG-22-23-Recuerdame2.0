@extends('layouts.structure')

@section('content')
<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de recuerdos</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <div class="row mb-2">
                <div class="col-12 justify-content-end d-flex">
                    <a href="/recuerdo/crear"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
                </div>
            </div>

        </div>
    </div>

    <div>
        <?php $i = 1; ?>
        <table id="tabla" class="table table-bordered table-striped table-responsive">
        <caption>Listado de recuerdos</caption>
        <thead>
        <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Etapa</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <!--<tbody>-->

            @foreach($recuerdos as $recuerdo)
            <tr>

                <th scope="row"><?php echo $i ?></th>

                <td><a href="/recuerdo/{{$recuerdo->id}}">{{$recuerdo->nombre}}</a></td>
                <td>{{$recuerdo->fecha}}</td>
                <td>{{$recuerdo->etapa->nombre}}</td>
                <td>{{$recuerdo->categoria->nombre}}</td>
                <td>{{$recuerdo->estado->nombre}}</td>
                <td>{{$recuerdo->etiqueta->nombre}}</td>
                <td class="tableActions">
                    <a href="/recuerdo/{{$recuerdo->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                    <?php if (Auth::user()->rol_id == 1) { ?>
                        <!-- Boton de editar -->
                        <a href="/recuerdo/{{$recuerdo->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
<!-- Boton de eliminar -->
                        <form method="post" action="{{ route('recuerdo.destroy', $recuerdo->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    <?php } ?>
                </td>
                <?php $i++; ?>
            </tr>
            @endforeach

        </table>
    </div>
    <script>
        function confirmar(e) {
            if (!confirm('¿Seguro que desea eliminar este recuerdo?')) {
                e.preventDefault();
            }
        }
    </script>
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