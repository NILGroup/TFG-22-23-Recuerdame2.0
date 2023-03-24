
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