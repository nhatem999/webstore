<?php get_header(); ?>
<?php $list_province = db_fetch_array("SELECT * FROM `tbl_province`");
$list_cart = get_list_buy_cart();
$info_cart = get_info_cart();
// show_array($list_cart);
global $error;
// show_array($error);
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="dat-hang.html" name="form-checkout">
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                
                <?php echo form_error('success')?>
               
           
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="" name="form-checkout">
                    <div class="form-row clearfix">
                        
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php if(!empty($_POST['fullname'])) echo $_POST['fullname']; ?>">
                            <?php echo form_error('fullname'); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">

                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php if(!empty($_POST['phone'])) echo $_POST['phone']; ?>">
                            <?php echo form_error('phone'); ?>
                        </div>


                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ:</label>
                            <label for="province">Tỉnh/Thành Phố</label>
                            <select name="province" class="province">
                                <option <?php if (isset($_POST['province'])) echo "selected='selected'"; ?> value="">-- Chọn Tỉnh/Thành Phố--</option>
                                <?php if (!empty($list_province)) foreach ($list_province as $province) {
                                ?>
                                    <option  value="<?php echo $province['name'] ?>"><?php echo $province['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('province'); ?>
                            <div class="form-col fl-right">
                                <label for="district">Quận/Huyện</label>
                                <select name="district" class="district">
                                    <option <?php if (isset($_POST['district'])) echo "selected='selected'"; ?> value="">-- Chọn Quận/Huyện --</option>
                                </select>
                            </div>
                            <?php echo form_error('district'); ?>
                            <label for="commune">Xã/Phường</label>
                            <select name="commune" class="commune">
                                <option <?php if (isset($_POST['commune'])) echo "selected='selected'"; ?> value="">-- Chọn Xã/Phường --</option>
                            </select>
                            <?php echo form_error('commune'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" rows="10" cols="75" placeholder="Ghi rõ địa chỉ đến số Nhà/Thôn, Xã/Phường, Quận/Huyện, Tỉnh/Thành phố! "><?php echo set_value('note') ?></textarea>
                            <?php echo form_error('note'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($list_cart) && !empty($list_cart)) {
                            foreach ($list_cart as $item) {
                        ?>
                                <tr class="cart-item">
                                    <td class="product-name"><a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-i.html"><?php echo $item['product_title'] ?></a> <strong class="product-quantity">x <?php echo $item['qty'] ?> </strong></td>
                                    <td class="product-total"><?php echo currency_format($item['sub_total']);  ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>


                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                                <?php if(isset($info_cart) && !empty($info_cart)){
                                    ?>
                                    <td><strong class="total-price"><?php echo currency_format($info_cart['total']) ;?></strong></td>
                                    <?php
                                }  ?>
                            
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                        <li>
                        
                        <div id="paypal-button"></div>
                        </li>
                        <li><input type="radio" id="payment-vnpay" name="payment-method" value="direct-vnpay">
                        <label for="payment-vnpay">Thanh toán qua Vnpay</label>
                        <img src="./public/images/VNPay.png" width="100px"alt="">
                        </li>

                    </ul>
                </div>
                <?php echo form_error('payment-method'); ?>
                <div class="place-order-wp clearfix">
                    <input type="submit" name="btn-buy-cart" id="order-now" value="Đặt hàng">
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<?php get_footer(); ?>