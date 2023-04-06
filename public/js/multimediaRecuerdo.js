let counter = 0

    $("#boton-modal-imagenes").on("click", function(event){
        $("#modal-descripcion").prop("value", "")
        $("#modal-file").prop("value", "")
    })

    $("#modal-imagenes-guardar").on("click", function(event){

        let file = $("#modal-file")
        let desc = $("#modal-descripcion")
        let files = file.prop("files")

        console.log(files)
        if (files.length > 0){


            let cloneFile = file.clone().removeAttr("id").hide()
            let cloneDesc = desc.clone().removeAttr("id").hide()

            let div = $("<div class='d-flex flex-column text-center recuerdo-imagenes'></div>")
            let imgDiv = $(`<img style='width: 8em' ></img>`)

            if (files[0].type.includes("image")){
                imgDiv.prop("src", URL.createObjectURL(cloneFile.prop("files")[0]))
            }
            else{
                imgDiv.prop("src", getRuta({fichero: files[0].name}))
            }
            
            
            
            div.append(imgDiv)
            div.append($(`<span data-pos='${counter++}' style='color: blue;'>Eliminar</span>`))
        

            $("#img-previews").append(div)
            $("#div-imagenes").append(cloneFile)
            $("#div-descripciones").append(cloneDesc)

        }

        $("#descripcionModal").modal("hide")

    })

    $("#img-previews").on("click", "span", function(event){
        let pos = $(event.target).data("pos")
        $("#img-previews").children().eq(pos).detach()
        $("#div-imagenes").children().eq(pos).detach()
        $("#div-descripciones").children().eq(pos).detach()

    })

    $("#recuerdo-guardar").on("click", function(event){
        let form = $("#recuerdo-form")

        event.stopPropagation()
        if (!form[0].checkValidity()){
            event.preventDefault()
        }

        form.addClass("was-validated")
        
    })