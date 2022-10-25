@extends('layouts.structure')

@section('content')

<div class="container-fluid">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de sesiones</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
        <div class="col-12 justify-content-end d-flex">
            <a href="{{route('sesiones.create')}}"><button type="button" class="btn btn-success btn-sm btn-icon"><i class="fa-solid fa-plus"></i></button></a>
        </div>
    </div>

    <div>
        <table class="table table-bordered table-striped table-responsive">
            <caption>Listado de sesiones</caption>
            <thead>
                <tr class="bg-primary">
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Objetivo</th>
                    <th scope="col">Finalizada/No finalizada</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($sesiones as $sesion)
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><a href="{{route('sesiones.show',$sesion->id)}}">{{date("d/m/Y", strtotime($sesion->fecha))}}</a></td>
                    <td>{{$sesion->objetivo}}</td>
                    <td>
                        @if($sesion->fecha_finalizada != null)
                        <i class="fa-solid fa-check text-success tableIcon"></i>{{date("d/m/Y", strtotime($sesion->fecha_finalizada))}}
                        @endif 
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if($sesion->fecha_finalizada == null)
                            <a class="btn btn-success btn-sm" style="width: 50%;" role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/generarInforme">Finalizar</a>
                            @else
                            <a class="btn btn-danger btn-sm" style="width: 50%;" role="button" href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/informe">Ver PDF</a>
                            @endif
                        </div>
                        
                
                    </td>
             
                    <td class="tableActions">
                        <a href="{{route('sesiones.show',$sesion->id)}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="/pacientes/{{$paciente->id}}/sesiones/{{$sesion->id}}/editar"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        
                        <form method="post" action="{{ route('sesiones.destroy', $sesion->id) }}" onclick="confirmar(event)" style="display:inline!important;">
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

<script>
    function confirmar(e) {
        if (!confirm('¿Seguro que desea eliminar esta sesión?')) {
            e.preventDefault();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush