window.setTimeout(function() {
    $(".alert").fadeTo(4000, 0).slideUp(4000, function(){
        $(this).remove(); 
    });
}, 4000);