"use strict"

$(function(){

    $("#guardar-multimedia").on("click", all)


})

function all(){

    let selected = getSelected()

    console.log(selected)

    addSelectedToDiv(selected)
}

function getSelected(){

    let selected = []

    $("#tabla-multimedias-existentes tbody input").each((i, e) =>{
        let elem = $(e)
        if(elem.prop("checked")){
            selected.push({
                id: Number(elem.prop("value")),
                nombre: elem.data("nombre"),
                fichero: elem.data("fichero")
            })
        }
    })

    $("#modalMultimedia").modal("hide")

    return selected
 
}   

function addSelectedToDiv(selected){

    let div = $("#showMultimedia")
    div.children().detach()

    selected.forEach(e => {
        div.append(getDiv(e))
    });

    
    
}

function getDiv(multimedia){
    

    let ruta = getRuta(multimedia)


    let e = `
    <div style="width: fit-content;">
        <div class="d-flex flex-column align-items-center mb-2" style="width: fit-content;">
                <div class="img-wrap">
                    <a href="${multimedia.fichero}" class="visualizarImagen">
                        <img style="height: 10em;" src="${ruta}" class="img-responsive-sm card-img-top img-thumbnail multimedia-icon imagen">
                    </a>
                </div>
                <small>${multimedia.nombre.slice(0, 20)}</small>
        </div>
    </div>`

    return e
}


function getRuta(multimedia){
    let ext = multimedia.fichero.split(".").pop()
   
    
    if (ext == 'pdf')
        return '/img/pdf.png'

    else if (["doc", "docx"].includes(ext))
        return '/img/word.jpg'

    else if (["ppt", "pptx", "pptm"].includes(ext))
        return '/img/power.jpg'

    else if (['xlsx', 'xlsm', 'xlsb'].includes(ext))
        return '/img/excel.jpg'

    else if (['png', 'jpg', 'jpeg'].includes(ext))
        return multimedia.fichero

    else if (['rar', 'zip', '7zip'].includes(ext))
        return '/img/rar.jpg'

    else if (['mp4', 'mkv', 'avi'].includes(ext))
        return '/img/video.png'

    else if (['mp3', 'ogg', 'wav', 'aac'].includes(ext))
        return '/img/audio.png'

    else 
        return '/img/undefined.jpg'
    

}



