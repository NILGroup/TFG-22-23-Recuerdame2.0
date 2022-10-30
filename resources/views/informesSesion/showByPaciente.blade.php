@extends('layouts.structure')

@section('content')

<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de informes de sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <div>
        <table id="tabla" class="table table-bordered table-striped table-responsive">
            <caption>Listado de informes de sesiones</caption>
            <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Informe</th>
                    <th scope="col">Fecha del informe</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach ($sesiones as $sesion)
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe">Informe de la sesión Nº {{$sesion->id}}</td>
                    <td>{{$sesion->fecha_finalizada}}</td>
                    <td class="tableActions">
                        <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/generarInforme"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('informesSesion.destroy', $sesion->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmar(e) {
        if (!confirm('¿Seguro que desea reabrir esta sesión?')) {
            e.preventDefault();
        }
    }
</script>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tabla').DataTable({
            paging: false,
            info: false,
            language: { 
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
                emptyTable: "No hay datos disponibles"
            },
            responsive: {
                details: {
                type: 'column',
                target: 'tr'
                }
            },
            dom : "<'row' <'form-control-sm mr-5' f>>"
        });
    });
</script>
@endpush