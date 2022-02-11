<?php

function construct()
{
    load('helper', 'url');
  
    load_model('index');

}

function indexAction()
{
    load_view('index');
}
function product(){
    $output = '';
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `title` FROM `tbl_produc_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    $query = "SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$cat['title']}' OR `brand` = '{$cat['title']}' OR `product_type` = '{$cat['title']}') ";
    # filter by arrange
    if (isset($_POST['filter']) && !empty($_POST['filter'])) {
        $arrange = $_POST['filter'];
        if ($arrange == 1) {
            $query .= 'ORDER BY `product_title` ASC ';
        }
        if ($arrange == 2) {
            $query .= 'ORDER BY `product_title` DESC ';
        }
        if ($arrange == 3) {
            $query .= 'ORDER BY `product_price_new` DESC ';
        }
        if ($arrange == 4) {
            $query .= 'ORDER BY `product_price_new` ASC ';
        }
    }
    $list_products_by_cat = db_fetch_array($query);
    $num_per_page = 4;
    #Tổng số bản ghi
    $total_row = count($list_products_by_cat);
    #Số trang
  
    $num_page = ceil($total_row / $num_per_page);
    if (isset($_POST['page_num']) && !empty($_POST['page_num'])) {
        $page_num = (int) $_POST['page_num'];
    } 
    else {
        $page_num = 1;
    }
    $start = ($page_num - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '<div class="section-detail">     
                        <ul class="list-item clearfix">';
    if (!empty($list_product_by_page)) {
        foreach ($list_product_by_page as $product_by_cat) {
            $output .= '
            <li>
                <a href=" '.$product_by_cat['slug'].'-'.$product_by_cat['product_id'].'-i.html" title="" class="thumb">
                    <img src="admin/' . $product_by_cat['product_thumb'] . '">
                </a>
                <a href=" '.$product_by_cat['slug'].'-'.$product_by_cat['product_id'].'-i.html" title="" class="product-name">' . $product_by_cat['product_title'] . '</a>
                <div class="price">
                    <span class="new">' . currency_format($product_by_cat['product_price_new']) . '</span>
                    <span class="old">' . currency_format($product_by_cat['product_price_old']) . '</span>
                </div>
                <div class="action clearfix">
                    <a href="?mod=cart&action=add_cart&product_id=' . $product_by_cat['product_id'] . '" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="?mod=home&action=buy_now&product_id=' . $product_by_cat['product_id'] . '" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>
        ';
        }
    } else{
        $output .= "<p class='error'>Không tồn tại sản phẩm nào!</p>";
    }
    $output .= '</ul>
            </div>';
    if(!empty($list_product_by_page)){
        $output .= '
        <div class="section" id="paging-wp">
            <div class="section-detail" id="pagging-filter">
                <ul class="list-item clearfix">
                    ' .get_pagging($num_page, $page_num,$cat_id). '
                </ul>
            </div>
        </div>';
    }   
    $data = array(
        'output' => $output,
        'num_page' => $num_page,
        'page_num' => $page_num,
    );
    echo json_encode($data);
}
function product_catAction()
{
    $output = '';
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `title` FROM `tbl_produc_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    $query = "SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$cat['title']}' OR `brand` = '{$cat['title']}' OR `product_type` = '{$cat['title']}') ";
    # filter by arrange
    if (isset($_POST['filter']) && !empty($_POST['filter'])) {
        $arrange = $_POST['filter'];
        if ($arrange == 1) {
            $query .= 'ORDER BY `product_title` ASC ';
        }
        if ($arrange == 2) {
            $query .= 'ORDER BY `product_title` DESC ';
        }
        if ($arrange == 3) {
            $query .= 'ORDER BY `product_price_new` DESC ';
        }
        if ($arrange == 4) {
            $query .= 'ORDER BY `product_price_new` ASC ';
        }
    }
    $list_products_by_cat = db_fetch_array($query);
    $num_per_page = 4;
    #Tổng số bản ghi
    $total_row = count($list_products_by_cat);
    #Số trang
  
    $num_page = ceil($total_row / $num_per_page);
    if (isset($_POST['page_num']) && !empty($_POST['page_num'])) {
        $page_num = (int) $_POST['page_num'];
    } 
    else {
        $page_num = 1;
    }
    $start = ($page_num - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '<div class="section-detail">     
                        <ul class="list-item clearfix">';
    if (!empty($list_product_by_page)) {
        foreach ($list_product_by_page as $product_by_cat) {
            $output .= '
            <li>
                <a href=" '.$product_by_cat['slug'].'-'.$product_by_cat['product_id'].'-i.html" title="" class="thumb">
                    <img src="admin/' . $product_by_cat['product_thumb'] . '">
                </a>
                <a href=" '.$product_by_cat['slug'].'-'.$product_by_cat['product_id'].'-i.html" title="" class="product-name">' . $product_by_cat['product_title'] . '</a>
                <div class="price">
                    <span class="new">' . currency_format($product_by_cat['product_price_new']) . '</span>
                    <span class="old">' . currency_format($product_by_cat['product_price_old']) . '</span>
                </div>
                <div class="action clearfix">
                    <a href="?mod=cart&action=add_cart&product_id=' . $product_by_cat['product_id'] . '" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="?mod=home&action=buy_now&product_id=' . $product_by_cat['product_id'] . '" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>
        ';
        }
    } else{
        $output .= "<p class='error'>Không tồn tại sản phẩm nào!</p>";
    }
    $output .= '</ul>
            </div>';
    if(!empty($list_product_by_page)){
        $output .= '
        <div class="section" id="paging-wp">
            <div class="section-detail" id="pagging-filter">
                <ul class="list-item clearfix">
                    ' .get_pagging_all($num_page, $page_num, $cat_id). '
                </ul>
            </div>
        </div>';
    }   
    $data = array(
        'output' => $output,
        'num_page' => $num_page,
        'page_num' => $page_num,
    );
    echo json_encode($data);
}

function detail_productAction()
{
    
    load_view('detail_product');
}
function cat_productAction(){

    load_view('category_product');
}