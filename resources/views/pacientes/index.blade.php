@extends('layouts.structure')

@section('content')
<div class="contenedor">
    <div class="pt-4 pb-2">
        <h5 class="text-muted">Listado de pacientes</h5>
        <hr class="lineaTitulo">
    </div>

    <div class="row mb-2">
    <div class="col-12 justify-content-end d-flex">
    
    <a href="/cuidadores/crear"><button type="button" style="background: transparent; border: 2px solid #0099CC; border-radius: 6px;" id="mybutton" class="btn-registro">Registro cuidador</button></a>
    <a href="{{route('pacientes.create')}}"><button type="button" style="background: transparent; border: 2px solid #0099CC; border-radius: 6px; border-color:green;" class="btn-newpaciente">Nuevo paciente</i></button></a>
    </div>
</div>

<div>
    <?php $i = 1;?>
    <table class="table table-bordered recuerdameTable">
        <thead>
            <tr>
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
            <tr>
            
                <th scope="row"><?php echo $i ?></th>
                
                <td><a href="/pacientes/{{$paciente->id}}/sesiones"> {{$paciente->nombre}}</a></td>
                <td>{{$paciente->apellidos}}</td>
                <td>
                <?php  if($paciente->genero == 'H') echo 'Hombre';
                else if($paciente->genero == 'M') echo 'Mujer'; ?>   
                </td>
                <td>
                <?php 
                        $fecha_nacimiento = new DateTime ($paciente->fecha_nacimiento);
                        $hoy = new DateTime();
                        $edad = $hoy->diff($fecha_nacimiento);
                        echo $edad->y ?>   
                </td>
                <td class="tableActions">
                    <div class="d-inline">
                    
                        <a href="/pacientes/{{$paciente->id}}"><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                        <a href="{{route('pacientes.edit',$paciente->id)}}"><i class="fa-solid fa-pencil text-primary tableIcon"></i></a>
                        <form method="post" action="{{ route('sesiones.destroy', $paciente->id) }}" onclick="confirmar(event)" style="display:inline!important;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button  type="submit" style="background-color: Transparent; border: none;"><i class="fa-solid fa-trash-can text-danger tableIcon"></i></button>
                        </form>
                        <a href="/pacientes/{{$paciente->id}}/asignar"><i class="fa-solid fa-users-line text-success tableIcon"></i></a>
                    </div>
                </td>
                <?php   $i++; ?>
            </tr>
        @endforeach
        

    </table>
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

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

@endpush