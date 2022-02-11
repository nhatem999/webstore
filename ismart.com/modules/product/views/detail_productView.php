<?php get_header();
$id = $_GET['product_id'];
$brand = get_info_product('parent_cat', $id);
$parent_cat = get_info_product('parent_cat', $id);
$query = "SELECT * FROM `tbl_products` WHERE  `parent_cat` = '{$parent_cat}' ";
$list_product = db_fetch_array($query);
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $brand; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" width="350px" height="350px" src="admin/<?php echo get_info_product('product_thumb', $id); ?>" data-zoom-image="admin/<?php echo get_info_product('product_thumb', $id); ?>" />
                        </a>
                        <div class="thumb-respon-wp fl-left">
                            <img src="admin/<?php echo get_info_product('product_thumb', $id); ?>" alt="">
                        </div>
                    </div>

                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo get_info_product('product_title', $id); ?></h3>
                        <div class="desc">
                            <p><?php echo get_info_product('product_desc', $id); ?></p>

                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php if (get_info_product('num_product', $id) > 0) {
                                                        echo "Còn hàng";
                                                    } else {
                                                        echo "Hết hàng";
                                                    } ?></span>
                        </div>
                        <p class="price"><?php echo currency_format(get_info_product('product_price_new', $id)); ?></p>

                        <form method="POST" id="num-order-wp" action="http://localhost/unitop/back-end/project/ismart.com.vn/ismart.com/?mod=cart&action=add_cart&product_id=<?php echo $id ?>">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            <hr>
                            <input type="submit" value="Thêm giỏ hàng" name="submit"  class="add-cart">
                        </form>


                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo get_info_product('product_content', $id); ?></p>

                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">

                    <ul class="list-item">
                        <?php foreach ($list_product as $item) {
                        ?>
                            <li>
                                <a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-i.html" title="" class="thumb">
                                    <img src="admin/<?php echo $item['product_thumb']; ?>">
                                </a>
                                <a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-i.html" title="" class="product-name"><?php echo $item['product_title']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['product_price_new']); ?></span>
                                    <span class="old"><?php echo currency_format($item['product_price_old']); ?></span>
                                </div>
                                <div class="action clearfix">

                                    <a href="<?php echo $item['slug'] ?>-<?php echo $item['product_id'] ?>-c.html" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        <?php
                        } ?>


                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>