@if($mostrarFoto)
<div class="row mb-4">
    <div class="img-wrap text-center w-25 mx-auto">
        @if (isset($cuidador->multimedia))
        <a href="#" class="visualizarImagen"><img src="{{$cuidador->multimedia->fichero}}" class="w-25 img-responsive-sm img-thumbnail" style="width: 10em;"></a>
        @else
        <a href="#" class="visualizarImagen"><img src="/img/avatar_hombre.png" class="img-responsive-sm img-thumbnail" style="width: 10em;"></a>
        @endif
    </div>
</div>
@endif