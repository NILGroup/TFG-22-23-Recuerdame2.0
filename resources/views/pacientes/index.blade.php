<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recuérdame</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         <script src="public/bootstrap-5.1.3-dist/js/bootstrap.js"></script>
        <!-- Styles 
        <style>
           

        </style>-->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="contenedor">
            <div class="pt-4 pb-2">
                <h5 class="text-muted">Listado de pacientes</h5>
                <hr class="lineaTitulo">
            </div>

            <div class="row mb-2">
            <div class="col-12 justify-content-end d-flex">
           
            <!--<a href="nuevoCuidador.php">--><button type="button" style="background: transparent; border: 2px solid #0099CC; border-radius: 6px;" id="mybutton" class="btn-registro">Registro cuidador</button></a>
            <!--<a href="nuevoPaciente.php?idUsuario=<!?php $usuario->getIdUsuario() ?> ">--><button type="button" style="background: transparent; border: 2px solid #0099CC; border-radius: 6px; border-color:green;" class="btn-newpaciente">Nuevo paciente</i></button></a>
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
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        @foreach($pacientes as $paciente)
                        <td>{{$paciente->nombre}}</td>
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
                                <!--<a href="verDatosPaciente.php?idPaciente=<!?php echo ($row['id_paciente']) ?>">--><i class="fa-solid fa-eye text-black tableIcon"></i></a>
                                <a href="{{route('pacientes.edit',$paciente->id)}}"><button class="fa-solid fa-pencil text-primary tableIcon">Editar</button></a>
                                <!--<a href="asignarTerapeuta.php?idPaciente=<!?php echo ($row['id_paciente']) ?>">--><i class="fa-solid fa-users-line text-success tableIcon"></i></a>
                                <!--<a href="gestor.php?accion=eliminarPaciente&idPaciente=<!?php echo ($row['id_paciente']) ?>">--><i class="fa-solid fa-trash-can text-danger tableIcon"></i></a>
                        </td>
                        @endforeach
                    </tr>
                    <?php   $i++; ?>
                          


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>