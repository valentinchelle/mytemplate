window.setTimeout(function() {
    $(".autoclose").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1200);