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

  <form method="POST" action="/usuarios/{{$usuario->id}}" class="mx-1 mx-md-4">
    <div class="card form-registro">
      <div class="d-flex justify-content-center">
        <img src="/img/Marca_recuerdame.png" class="card-img-top logo">
      </div>
      <h5 class="text-center text-muted">Registro terapeuta</h5>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ ($error == "El campo password2 y password debe coincidir.") ? "Las contraseñas no coinciden" : $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
        <input type="text" id="apellidos" class="form-control form-control-sm" name="nombre" value="{{$usuario->nombre}}" placeholder="Nombre"  required>
        {{csrf_field()}}
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
        <input type="text" id="apellidos" class="form-control form-control-sm" name="apellidos" value="{{$usuario->apellidos}}" placeholder="Apellidos" required>
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
        <input type="text" id="nick" class="form-control form-control-sm" name="usuario" value="{{$usuario->usuario}}" placeholder="Nombre de usuario" required>
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
        <input type="email" id="email" class="form-control form-control-sm" name="email" value="{{$usuario->email}}" placeholder="Correo electrónico" required>
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
        <input type="password" id="password" class="form-control form-control-sm" name="password" value="{{$usuario->password}}" placeholder="Contraseña" required />
      </div>

      <div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
        <input type="password" id="password2" class="form-control form-control-sm" name="password2" value="{{$usuario->password2}}" placeholder="Confirmar contraseña" required />
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" id="registrarNuevo" class="btn btn-primary btn-sm">Registrar</button>
      </div>
    </div>
  </form>

</body>
<html>