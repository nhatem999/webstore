$(document).ready(function(){
    $("#icon-menu-responsive").click(function(){
    //   click xong => Hiện thị menu respon bằng việc xỏ từ trên xuống
    $("#respon-menu").slideToggle(); // SlideDown,slideUp, slideToggle 

    return false;
    });
    $(window).resize(function(){
        // Nếu màn hình có độ rộng lớn hơn 768px thì respon-menu nó phải ẩn đi
        if($(document).width() >= 768){
            $("#respon-menu").css('display',"none");
        }
    });
});