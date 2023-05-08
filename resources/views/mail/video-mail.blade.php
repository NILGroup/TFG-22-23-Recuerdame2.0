<x-mail::message>
# Su vídeo está listo

A partir de ahora podrá visualizar su vídeo en el siguiente enlace

<x-mail::button :url="$url">
Ver vídeo
</x-mail::button>

Gracias por usar nuestros servicios,<br>
El equipo de {{ config('app.name') }}
<img src="{{ $message->embed($logo) }}" alt="Logo Recuérdame 2.0">
</x-mail::message>
