function cambiarRequired(input, fecha){
    let req = ($(input).prop("value") || $(fecha).prop("value")) ? 1 : 0
    $(input).prop("required", req)
    $(fecha).prop("required", req)  
}

function cambiarRequiredCustom(value){
    $("#nombre_escala").prop("required", value)
    $("#escala").prop("required", value)
    $("#fecha_escala").prop("required", value)
}

$("#nombre_escala").on("keyup", (e) => cambiarRequiredCustom(($("#escala").prop("value") || $("#nombre_escala").prop("value") || $("#fecha_escala").prop("value"))))
$(".custom-control").each((i, e) => $(e).on("change", (ev) =>cambiarRequiredCustom(($("#escala").prop("value") || $("#nombre_escala").prop("value") || $("#fecha_escala").prop("value")))))
$(".cdr-control").each((i, e) => $(e).on("change", (ev) => cambiarRequired("#cdr", "#cdr_fecha")))
$(".mental-control").each((i, e) => $(e).on("change", (ev) => cambiarRequired("#mental", "#mental_fecha")))
$(".gds-control").each((i, e) => $(e).on("change", (ev) => cambiarRequired("#gds", "#gds_fecha")))




$(document).ready(function () {
    $("input[type='number']").each(function(){
        if($(this).attr("max")){
            var v =  "/ " + $(this).attr('max');
            if(v.length < 4){
                v = v+"  "
            }
            $(this).TouchSpin({
                buttondown_class:"hidden",
                buttonup_class:"hidden",
                postfix: v
            });
        }
        
    })
});