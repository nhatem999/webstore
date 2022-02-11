$(document).ready(function(){
    $("a#icon-menu-responsive").click(function(){
        $("#site").toggleClass('open-respon-menu');

        return false;
    });
    $(window).resize(function(){
        if($(window).width() >= 800){
            $("#site").removeClass('open-respon-menu');
        }
    });

   
}); 