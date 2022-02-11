// page product
$(document).ready(function() {
    $(".number-page").click(function(){
        var page = $(this).text();
        var cat_id = $(this).attr('cat_id');
        var data = {page: page,cat_id: cat_id}
        console.log(data);
        $.ajax({
            url: 'http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=product&controller=index&action=product',
            method: 'POST',
            data:data,
            dataType: 'text',
            success: function(data){
                // $().html(data.output);
                console.log(data);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    });
});
$(document).ready(function(){
    function get_data(cat_id, page_num){
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = {page_num: page_num, cat_id: cat_id, arrange: arrange};
        console.log(data);
        $.ajax({
            url: 'http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=product&controller=index&action=product_cat',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data){
                $('#'+cat_id).html(data.output);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    };
    $(document).on("click", ".num-page", function () {
        var cat_id = $(this).attr('cat-id');
        var page_num = $(this).text();
        get_data(cat_id, page_num);
    });
});
// num-order
$(document).ready(function () {
    $(".num-order").change(function () {
        var num_order = $(this).val();
        var product_id = $(this).attr('data-id');
        var data = {num_order: num_order, product_id: product_id};
        // console.log(data);
        $.ajax({
            url: 'http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=cart&controller=index&action=update_cart',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data){
              $(".sub-total-"+product_id).html(data.sub_total);
              $("#total-price span").html(data.total)
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        })
    });
});
// Chọn Thành phố - Quận
$(document).ready(function (){
    $(".province").change(function () {
        var province = $(this).val();
        var data = {province: province};
        $.ajax({
            url: 'http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=cart&action=district',
            method: 'POST',
            data: data,
            dataType: 'text',
            success: function(data){
                $('.district').html(data);
                // console.log(data);
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    });
});
$(document).ready(function (){
    $(".district").change(function () {
        var district = $(this).val();
        var data = {district: district};
        $.ajax({
            url: 'http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=cart&action=select_commune',
            method: 'POST',
            data: data,
            dataType: 'text',
            success: function(data){
                $('.commune').html(data);
                
            },
            error: function (xhr, ajaxoptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    });
});
