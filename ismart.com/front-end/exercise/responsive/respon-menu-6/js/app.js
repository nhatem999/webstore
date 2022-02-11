$(document).ready(function(){
    $("a#icon-menu-responsive").click(function(){
        // $(this).toggleClass('open-respon-menu');
        $("#site").toggleClass('open-respon-menu');
        // $(this).removeClass("fa fa-navicon");
        // $(this).addClass("fa fa-times");
        $("a#icon-menu-responsive").toggleClass('fa fa-navicon fa fa-times');

        return false;
    });
    $(window).resize(function(){
        if($(window).width() >= 800){
            $("#site").removeClass('open-respon-menu');
            $("a#icon-menu-responsive").removeClass('fa-times').addClass('fa fa-navicon fa ');
        }
    });
   
}); 