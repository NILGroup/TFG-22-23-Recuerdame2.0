function especifiqueResidencia() {
    let select = document.getElementById("residencia")
    if (select.value === "5") {
        //console.log($("#fecha_inscipcion").show())
    } else {
        //console.log($("#fecha_inscipcion").hide())
        //$("#fecha_inscripcion").hide()
    }
    if (select.value === "6") {
        $("#residencia_custom").show()
    } else {
        $("#residencia_custom").hide()
    }
}

function especifique(){
    let select = document.getElementById("tiporelacion_id")
    if (select.value === "7"){
        $("#tipo_custom").show()
    }
    else{
        $("#tipo_custom").hide()
    }
}