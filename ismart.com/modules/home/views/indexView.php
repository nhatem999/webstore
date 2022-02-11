<?php get_header(); ?>
<?php
$featured_product = db_fetch_assoc("SELECT `product_code` FROM `tbl_product_order`");
$product = db_fetch_array("SELECT DISTINCT `product_code` FROM `tbl_product_order`");

$list_products = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' ORDER BY `product_id` DESC");
$list_product_cat = db_fetch_array("SELECT* FROM `tbl_produc_cat` WHERE `parent_id` = 0");

?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php if (isset($product) && !empty($product)) {
                            foreach ($product as $item) {
                        ?>
                                <li>
                                    <a href="<?php echo  get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']); ?>-i.html" title="" class="thumb">
                                        <img src="admin\<?php echo get_info_product_by_code('product_thumb',$item['product_code']); ?>">
                                    </a>
                                    <a href="" title="" class="product-name"><?php echo get_info_product_by_code('product_title',$item['product_code']); ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo get_info_product_by_code('product_price_new',$item['product_code']); ?></span>
                                        <span class="old"><?php echo get_info_product_by_code('product_price_old',$item['product_code']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']) ?>-c.html" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']) ?>-b.html" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php
                            }
                        } ?>


                    </ul>
                </div>
            </div>
            <?php if(!empty($list_product_cat)){
                foreach($list_product_cat as $product_cat){
                    $list_product_by_cat= get_product_by_parent_cat($product_cat['title']);

                    ?>
                      <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $product_cat['title'] ?></h3>
                        </div>
                       
                            <div class="section-detail">
                            <?php if (!empty($list_product_by_cat)) {
                                    $error = array();
                                ?>       
                                <ul class="list-item clearfix">
                                    <?php foreach ($list_product_by_cat as $product_by_cat) {
                                        ?>
                                    <li>
                                        <a href="<?php echo $product_by_cat['slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="thumb">
                                            <img src="admin/<?php echo $product_by_cat['product_thumb'] ?>">
                                        </a>
                                        <a href="<?php echo $product_by_cat['slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="product-name"><?php echo $product_by_cat['product_title'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($product_by_cat['product_price_new']) ?></span>
                                            <span class="old"><?php if(!empty($product_by_cat['product_price_old'])) echo currency_format($product_by_cat['product_price_old']) ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="gio-hang-<?php echo $product_by_cat['product_id'] ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="dat-hang-<?php echo $product_by_cat['product_id'] ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                                <?php
                                } else {
                                    $error['product_cat'] = 'Hiện không tồn tại sản phẩm '.$product_cat['title'].' nào!';
                                ?>
                                    <p class="error"><?php echo  $error['product_cat'] ?></p>
                                <?php
                                }
                                ?>
                            </div>
                           
                        
                    </div>
                    
                    
                    
                    
                    <?php
                }
                
            } ?>
            
          
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>