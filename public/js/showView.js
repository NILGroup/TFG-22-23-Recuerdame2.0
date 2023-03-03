$("input, select").each(function () {
    console.log($(this).prop("type"))
    if(!$(this).is(":hidden") && !$(this).hasClass("search"))
    switch ($(this).prop("type")) {
        case "checkbox":
        case "range":
            $(this).prop("disabled", true)
            break;
        case "select-one":
            $(this).replaceWith("<label> " + $(this).find("option:selected").text() + "</label>");
            break;
        case "date":
            $(this).replaceWith("<label> " + new Date($(this).val()).toLocaleDateString('en-GB')  + "</label>");
            break;
        case "datetime-local":
            $(this).replaceWith("<label> " + new Date($(this).val()).toLocaleDateString('en-GB') + " " + new Date($(this).val()).toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })  + "</label>");
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