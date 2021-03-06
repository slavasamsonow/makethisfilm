$(document).ready(function(){
    $('form').submit(function(event){
        if($(this).hasClass('no_ajax')){
            return;
        }
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result){
                json = jQuery.parseJSON(result);
                if(json.url){
                    window.location.href = '/' + json.url;
                }else if(json.urlo){
                    window.location.href = json.urlo;
                }else if(json.console){
                    console.log(json.console);
                }
            },
        });
    });



})