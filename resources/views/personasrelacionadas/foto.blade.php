@if($mostrarFoto)
<div class="row pb-2">
    <div class="img-wrap text-center mx-auto">
        @if (isset($persona->multimedia))
        <a href="#" class="visualizarImagen"><img src="{{$persona->multimedia->fichero}}" class="imagenPaciente img-responsive-sm img-thumbnail" style="width: 10em;"></a>
        @elseif ($persona->genero_id == '2')
        <a href="#" class="visualizarImagen"><img src="/img/avatar_mujer.png" class="imagenPaciente img-responsive-sm img-thumbnail" ></a>
        @else 
        <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="imagenPaciente img-responsive-sm img-thumbnail" ></a>
        @endif
    </div>
</div>
@endif

