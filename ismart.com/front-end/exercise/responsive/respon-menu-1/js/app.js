$(document).ready(function(){
    $("a#icon-menu-responsive").click(function(){
       $("ul#respon-menu").slideToggle();

        return false;
    });
    $(window).resize(function(){
        if($(window).width() >= 800){
            $("ul#respon-menu").css('display','none');
        }
    });

   
}); 