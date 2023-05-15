<x-mail::message>
# Su vídeo "{{$titulo}}" está listo

A partir de ahora podrá visualizar su vídeo en el siguiente enlace

<x-mail::button :url="$url">
Ver vídeo
</x-mail::button>

Gracias por usar nuestros servicios,<br>
El equipo de {{ config('app.name') }}
<img src="https://drive.google.com/uc?export=view&id=1Ksde2N6_PY-ffoAxlUNw86EBi2FCkGzR" class="img-header">
</x-mail::message>
