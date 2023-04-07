<div style="width: fit-content;">
        
        <div class="d-flex flex-column align-items-center mb-2" style="width: fit-content;">
            <div class="img-wrap">
                <a href="{{$media->fichero}}" class="visualizarImagen">
                    <img style="height: 10em;" src="{{$media->getRuta()}}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon imagen">
                </a>
            </div>
            <small>{{substr($media->nombre, 0, 20);}}</small>
        </div>
       
</div>