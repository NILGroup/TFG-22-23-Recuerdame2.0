var inputs = 0;
$(document).ready(function () {
    let barra = $('<div id="formBar" class="position-fixed bottom-5 start-50 translate-middle formBar rounded-pill border border-dark w-25"></div>');
    $('body').append(barra);
    var bar = new ProgressBar.Line('#formBar', {
        color: '#629cff',
        strokeWidth: 1,
        trailColor: '#eee',
        trailWidth: 0.15,
        svgStyle: {
            display: 'block',
            width: '100%',
            height:'100%',
        },
        text: {
            autoStyleContainer: true,
            style:{
                color: '#000',
                position: 'absolute',
                left: '50%',
                top: '50%',
                padding: 0,
                margin: 0,
                transform: {
                    prefix: true,
                    value: 'translate(-50%, -50%)'
                }
            }
        },
        step: (state, bar) => {
            bar.setText(Math.round(bar.value() * 100) + ' % completado');
        }
    });

    this.elements = function () {
        var formElements = $(this).find("input, textarea, select").toArray()
        arr = [];
        formElements.map(function (item) {
            if(!$(item).is(":hidden") && !item.name == ""){
                arr[item.name] = 0;
                if(item.checked)
                    arr[item.name] = 1;
            }
        })
        return arr;
    }

    this.refresh = function () {
        formFields = this.elements();
    }

    this.renderBar = function () {
        var correctFields = 0
        var length = 0;
        var error = false;
        for(var item in formFields){
            if(formFields[item]==1){
                correctFields++;
            }
            if(formFields[item]==-1)
                error=true;
            length++;
        }

        var percentOfSuccess = (correctFields/length).toFixed(2);
        console.log(formFields)
        bar.animate(percentOfSuccess);
    }

    this.bindElements = function () {
        var editBar = this.renderBar
        $(this).find("input, textarea, select").change(function () {
                switch ($(this).prop('nodeName')){
                case "INPUT":
                    switch ($(this).attr("type")){
                    case "text":
                        if($(this).val()!=""){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                        break;
                    case "email":
                        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        if(re.test(String($(this).val()).toLowerCase())){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                        break;
                    case "number":
                        if($.isNumeric($(this).val())){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                        break;
                    case "checkbox":
                        if($(this).is(':checked')){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                        break;
                    case "radio":
                        if($(this).is(':checked')){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                        break;
                    case "date":
                        if(Date.parse( $(this).val() ) ){
                            formFields[$(this).attr("name")]=1
                        }else{
                            formFields[$(this).attr("name")]=0
                        }
                    }
                    break;
                case "SELECT":
                    if($(this).val()!=""){
                        formFields[$(this).attr("name")]=1
                    }else{
                        formFields[$(this).attr("name")]=0
                    }
                    break;

                }
            editBar();
        })
    }
    
    var formFields = this.elements();
    this.bindElements();
});

