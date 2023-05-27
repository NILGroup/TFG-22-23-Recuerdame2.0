/*Al añadir un nuevo fichero se comprueba el tamaño del mismo y si supera el maximo permitido. */
$("#modal-file").on("change", (e) => {

    let submit = $("#modal-imagenes-guardar")
    let error = $("#file-error")
   
    if (e.target.files[0].size > 2097152){
        submit.prop("disabled", true)

        if (error.length === 0)
            $("#modal-file").after("<small id='file-error' class='text-danger'>El archivo es demasiado grande</small>")
    }
    else{
        if (error.length > 0)
            error.remove()
        submit.prop("disabled", false)
    }
})

/**Al hacer click en el botón que despliega el modal se resetean los campos del mismo y los errores */
    $("#boton-modal-imagenes").on("click", function(event){
        $("#modal-descripcion").prop("value", "")
        $("#modal-file").prop("value", "")
        $("#modal-imagenes-guardar").prop("disabled", false)
        if ($("#file-error").length > 0)
            $("#file-error").remove()
    })
   
/**Al hacer click en el botón de guardar el modal se añade el fichero a la cola */
    $("#modal-imagenes-guardar").on("click", function(event){

        let file = $("#modal-file")
        let desc = $("#modal-descripcion")
        let files = file.prop("files")

        console.log(files)
        if (files.length > 0){


            let cloneFile = file.clone().removeAttr("id").hide()
            let cloneDesc = desc.clone().removeAttr("id").hide()

            let div = $("<div class='d-flex flex-column text-center recuerdo-imagenes'></div>")
            let backgroundDiv = $("<div style='background-color:white; border-radius: 15px'></div>")

            let imgDiv = $(`<img style='width: 8em; height: 8em;' ></img>`)

            if (files[0].type.includes("image")){
                imgDiv.prop("src", URL.createObjectURL(cloneFile.prop("files")[0]))
            }
            else{
                imgDiv.prop("src", getRuta({fichero: files[0].name}))
            }
            
            backgroundDiv.append(imgDiv)
            
            
            div.append(backgroundDiv)
            div.append($(`<span style='color: blue;'>Eliminar</span>`))
        

            $("#img-previews").append(div)
            $("#div-imagenes").append(cloneFile)
            $("#div-descripciones").append(cloneDesc)

        }

        $("#descripcionModal").modal("hide")

    })

// función que elimina una imagen de la cola
    $("#img-previews").on("click", "span", function(event){
        let pos = $(event.target).parent().index()
        
        $("#img-previews").children().eq(pos).detach()
        $("#div-imagenes").children().eq(pos).detach()
        $("#div-descripciones").children().eq(pos).detach()

    })

// función que valida el formulario del recuerdo y si es válido lo envia
    $("#recuerdo-guardar").on("click", function(event){
        let form = $("#recuerdo-form")

        event.stopPropagation()
        if (!form[0].checkValidity()){
            event.preventDefault()
        }

        form.addClass("was-validated")
        
    })