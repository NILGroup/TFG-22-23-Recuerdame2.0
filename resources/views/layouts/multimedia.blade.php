<div style="width: fit-content;">

        @php
            $ext = pathinfo($media->fichero, PATHINFO_EXTENSION);
            $ruta = $media->fichero;

            if ($ext == 'pdf'){
                $ruta = '/img/pdf.png';
            }
            elseif(in_array($ext, array('doc', 'docx'))){
                $ruta = '/img/word.jpg';
            }
            elseif (in_array($ext, array('ppt', 'pptx', 'pptm'))){
                $ruta = '/img/power.jpg';
            }
            elseif (in_array($ext, array('xlsx', 'xlsm', 'xlsb'))){
                $ruta = '/img/excel.jpg';
            }
            elseif (in_array($ext, array('png', 'jpg', 'jpeg'))){
                $ruta = $media->fichero;
            }
            elseif (in_array($ext, array('rar', 'zip', '7zip'))){
                $ruta = '/img/rar.jpg';
            }
            else if (in_array($ext, array('mp4', 'mkv', 'avi'))){
                $ruta = '/img/video.png';
            }
            else if (in_array($ext, array('mp3', 'ogg', 'wav', 'aac'))){
                $ruta = '/img/audio.png';
            }
            else{
                $ruta = '/img/undefined.jpg';
            }

        @endphp
        
        <div class="d-flex flex-column align-items-center mb-2" style="width: fit-content;">
            <div class="img-wrap">
                <a href="{{$media->fichero}}" class="visualizarImagen">
                    <img style="height: 10em;" src="{{$ruta}}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon imagen">
                </a>
            </div>
            <small>{{substr($media->nombre, 0, 20);}}</small>
        </div>
       
 
    </div>