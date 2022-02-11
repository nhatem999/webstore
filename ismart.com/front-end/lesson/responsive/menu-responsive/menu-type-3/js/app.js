$(document).ready(function(){
    $("#icon-menu-responsive").click(function(){
    //   click xong => Hiện thị menu respon bằng việc xỏ từ trên xuống
    $("#site").toggleClass('open-respon-menu');
    //  $("#site").slideToggle(400);      
    return false;
    });
    $(window).resize(function(){
        // Nếu màn hình có độ rộng lớn hơn 768px thì respon-menu nó phải ẩn đi
        if($(document).width() >= 768){
             $("#site").removeClass('open-respon-menu');   
        }
    });
});
