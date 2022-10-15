@extends('layouts.structure')

@section('content')

<div class="contenedor">
        <div class="pt-4 pb-2">
            <h5 class="text-muted">Listado de informes de seguimiento</h5>
            <hr class="lineaTitulo">
        </div>

        <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
                <a href="/pacientes/{{$paciente->id}}/evaluaciones/generarInforme"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
            </div>
        </div>

        <div>
            <table class="table table-bordered recuerdameTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Informe</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Diagnóstico</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($evaluaciones as $informe)
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe">Informe Nº {{$informe->id}}</td>
                            <td>{{$informe->fecha}}</td>
                            <td>{{$informe->diagnostico}}</td>
                            <td class="tableActions">
                                <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/informe"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                <a href="/pacientes/{{$paciente->id}}/evaluaciones/{{$informe->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                                <form method="post" action="{{ route('evaluaciones.destroy', $informe->id) }}" onclick="confirmar(event)" style="display:inline!important;">
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

@endsection

@push('scripts')
<script>
function confirmar(e)
{
    if(!confirm('¿Seguro que desea eliminar esta sesión?')) {
        e.preventDefault();
    }
}
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush
