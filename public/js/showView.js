$("input, select").each(function () {
    //console.log($(this).prop("type"))
    if(!$(this).is(":hidden") && !$(this).hasClass("search"))
    switch ($(this).prop("type")) {
        case "checkbox":
            break;
        case "range":
            break;
        case "select-one":
            $(this).replaceWith("<label> " + $(this).find("option:selected").text() + "</label>");
            break;
        default:
            $(this).replaceWith("<label> " + $(this).val() + "</label>");
            break;
    }
});

$(".asterisco").each(function () {
    $(this).remove();
})