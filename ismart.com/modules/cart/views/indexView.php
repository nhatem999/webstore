
<?php get_header(); 
    $list_buy_cart = get_list_buy_cart();
   $info_cart = get_info_cart();
       
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($list_buy_cart)){

                        foreach ($list_buy_cart as $item) {
                        ?>
                            <tr>
                                <td><?php echo $item['product_code']; ?></td>
                                <td>
                                    <a href="" title="" class="thumb">
                                        <img src="admin\<?php echo $item['product_thumb']; ?>" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-i.html" title="" class="name-product"><?php echo $item['product_title']; ?></a>
                                </td>
                                <td><?php echo currency_format($item['product_price_new']) ; ?></td>
                                <td>
                                    <input type="number" min="0" max="20"name="num-order" data-id="<?php echo $item['product_id'] ?>" value="<?php echo $item['qty']; ?>" class="num-order">
                                </td>
                                <td ><p class="sub-total-<?php echo $item['product_id']?>"><?php echo currency_format($item['sub_total']) ; ?></p></td>
                                    
                                <td>
                                    <a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-d.html" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                        ?>
                      
                    </tbody>
                   
                    <tfoot>
                   
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($info_cart['total']);  ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                        <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br />
                <a href="" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>