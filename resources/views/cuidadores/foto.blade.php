@if($mostrarFoto)
<div class="row pb-2">
    <div class="img-wrap text-center mx-auto">
        @if (isset($cuidador->multimedia))
        <a href="#" class="visualizarImagen"><img src="{{$cuidador->multimedia->fichero}}" class="imagenPaciente img-responsive-sm img-thumbnail"></a>
        @else
        <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="imagenPaciente img-responsive-sm img-thumbnail" ></a>
        @endif
    </div>
</div>
@endif