<?php
$list_products = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' ORDER BY `product_id` DESC");
$list_cat = db_fetch_array("SELECT* FROM `tbl_produc_cat` WHERE `parent_id` = 0");
$list_product_cat = db_fetch_array("SELECT * FROM `tbl_produc_cat` WHERE `parent_id` = 1 ");
$product = db_fetch_array("SELECT DISTINCT `product_code` FROM `tbl_product_order`");

?>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <?php if (isset($list_cat) && !empty($list_cat)) {
                    foreach ($list_cat as $item) {
                        $list_brand = get_brand($item['cat_id']);
                        // show_array($list_brand);
                ?>
                        <li>
                            <a href="<?php echo $item['slug'] ?>-<?php echo $item['cat_id'] ?>-cat.html" title=""><?php echo $item['title'] ?></a>
                            <ul class="sub-menu">
                                <?php
                                if (!empty($list_brand)) {
                                    foreach ($list_brand as $brand) {
                                ?>
                                        <li>
                                            <a href="<?php echo $brand['slug'] ?>-<?php echo $brand['cat_id'] ?>-cat.html" title=""><?php echo $brand['title'] ?></a>
                                        </li>

                                <?php
                                    }
                                }
                                ?>


                            </ul>
                        </li>
                <?php
                    }
                } ?>
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                <?php if (isset($product) && !empty($product))
                    foreach ($product as $item) {
                ?>
                    <li class="clearfix">
                        <a href="<?php echo  get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']); ?>-i.html" title="" class="thumb fl-left">
                            <img src="admin\<?php echo get_info_product_by_code('product_thumb',$item['product_code']); ?>" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="<?php echo  get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']); ?>-i.html" title="" class="product-name"><?php echo get_info_product_by_code('product_title',$item['product_code']); ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format(get_info_product_by_code('product_price_new',$item['product_code'])) ; ?></span>
                                <span class="old"><?php echo currency_format(get_info_product_by_code('product_price_old',$item['product_code'])); ?></span>
                            </div>
                            <a href="<?php echo get_info_product_by_code('slug',$item['product_code']) ?>-<?php echo get_info_product_by_code('product_id',$item['product_code']) ?>-b.html" title="" class="buy-now">Mua ngay</a>
                        </div>
                    </li>

                <?php
                    }
                ?>


            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>