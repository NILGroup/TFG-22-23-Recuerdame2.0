/*
* Todo este script modifica las vistas show, cambiando los inputs
* por labels, desactivandolos, etc.
*/



$("input, select").each(function () {
    if(!$(this).is(":hidden") && !$(this).hasClass("search"))
    switch ($(this).prop("type")) {
        case "checkbox":
        case "range":
            $(this).prop("disabled", true)
            break;
        case "select-one":
            if($(this).find("option:selected").text() != "Otro")
                $(this).replaceWith("<label> " + $(this).find("option:selected").text() + "</label>");
            else{
                $(this).remove();
            }
            break;
        case "date":
            if($(this).val())
                $(this).replaceWith("<label> " + new Date($(this).val()).toLocaleDateString('en-GB')  + "</label>");
            else
                $(this).replaceWith("<label> </label>");
            break;
        case "datetime-local":
            $(this).replaceWith("<label> " + new Date($(this).val()).toLocaleDateString('en-GB') + " " + new Date($(this).val()).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })  + "</label>");
            break;
        case "number":
            if($(this).attr('max'))
                $(this).replaceWith("<label> " + $(this).val() + " / " + $(this).attr('max') + "</label>");
            else
                $(this).replaceWith("<label> " + $(this).val()  + "</label>");

            break;
        default:
            $(this).replaceWith("<label> " + $(this).val() + "</label>");
            break;
    }
});

$("textarea").each(function () {
    $(this).prop("disabled", true)
})
$(".asterisco").each(function () {
    $(this).remove();
})