<html>

<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recuérdame</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Fontawesome5 -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/registro.css">
        <link rel="stylesheet" href="/css/styles.css">
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
    <form action="/loguear" method="POST" class="mx-1 mx-md-4">
        {{csrf_field()}}
        <div class="card form-login">
            <img src="/img/Marca_recuerdame.png" class="card-img-top">
            <div class="card-body">
                @if ($registrado)
                        <p text-align = "center" style="color:green;">Terapeuta registrado correctamente</p>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" style = "width:100%">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row mb-3">
                    <input class="form-control" type="text" name="usuario" value="" placeholder="Correo electrónico" required>
                </div>

                <div class="row mb-3">
                    <input class="form-control" type="password" name="password" value="" placeholder="Contraseña" required>
                </div>


                <div class="d-grid gap-2  justify-content-md-end">
                    <div class="btn-group">
                         <a href="/registro" class="btn btn-outline-primary btn-sm">Registro terapeuta</a>
                         <button type="submit" name="login" style="border-color:green;" class="btn btn-primary btn-sm">Iniciar sesión</button>
                    </div>
                </div>
                <p></p>
                <p></p>
                <a href="/login" >¿Has olvidado la contraseña?</a>
            </div>
        </div>
    </form>
</body>

</html>