function especifiqueResidencia() {
    let select = document.getElementById("residencia")
    if (select.value === "6") {
        $("#residencia_custom").show()
    } else {
        $("#residencia_custom").hide()
    }
    if (select.value === "5") {
        $("#fecha_inscipcion").show()
        $("#fecha_inscipcion input").eq(0).prop("required", true)
    } else {
        $("#fecha_inscipcion").hide()
        $("#fecha_inscipcion input").eq(0).prop("required", false)
    }
}

function especifique(){
    let select = document.getElementById("tiporelacion_id")
    if (select.value === "7"){
        $("#tipo_custom").show().prop("required", true)
        
    }
    else{
        $("#tipo_custom").hide().prop("required", false)
    }
}

function especifiqueCategoria(){
    let select = document.getElementById("categoria_id")
    if (select.value === "7"){
        $("#categoria_custom").show().prop("required", true);
    }else{
        $("#categoria_custom").hide().prop("required", false);
    }
}

function especifiqueGenero(){
    let select = document.getElementById("genero_id")
    if (select.value === "3"){
        $("#genero_custom").show().prop("required", true)
    }
    else{
        $("#genero_custom").hide().prop("required", false)
    }
}