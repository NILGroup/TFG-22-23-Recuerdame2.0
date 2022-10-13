@extends('layouts.structure')

@section('content')

<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de informes de sesión</h5>
        <hr class="lineaTitulo">
    </div>

    <div>
        <table class="table table-bordered recuerdameTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Informe</th>
                    <th scope="col">Fecha del informe</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                @foreach ($sesiones as $sesion)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe">Informe de la sesión Nº {{$sesion->id}}</td>
                        <td>{{$sesion->fecha_finalizada}}</td>
                        <td class="tableActions">
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/generarInforme"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <form method="post" action="{{ route('informes.destroy', $sesion->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button  type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
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
function confirmar(e)
{
    if(!confirm('¿Seguro que desea reabrir esta sesión?')) {
        e.preventDefault();
    }
}
</script>
@endsection
