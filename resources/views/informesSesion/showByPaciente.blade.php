@extends('layouts.structure')

@section('content')

<div class="container-fluid">
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
                    <th scope="col">Apto para continuar</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach ($sesiones as $sesion)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/informe">Informe de la sesión Nº {{$sesion->id}}</td>
                        <td>{{date("d/m/Y H:i", strtotime($sesion->fecha_finalizada))}}</td>
                        <td>
                            <div class="d-flex justify-content-center">    
                                @if($sesion->apto) 
                                    <i class="fa-solid fa-check text-success"></i> 
                                @else 
                                    <i class="fa-solid fa-xmark text-danger"></i> 
                                @endif
                            </div>
                        </td>
                        <td class="tableActions">
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/ver"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                            <a href="/pacientes/{{$sesion->paciente_id}}/sesiones/{{$sesion->id}}/generarInforme"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                            <form method="post" action="{{ route('informesSesion.destroy', $sesion->id) }}" style="display:inline!important;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background-color: Transparent; border: none;" class="confirm_delete"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
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
    @include('layouts.scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/table.js"></script>
    <script src="/js/confirm.js"></script>
@endpush