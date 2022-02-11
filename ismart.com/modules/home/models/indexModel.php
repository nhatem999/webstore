<?php

function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}


function get_info_product($product_id){
    $info_product_id = db_fetch_row("SELECT*FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id;
    }
}
function get_product_by_parent_cat($parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}') $order_by");
    return $list_product_by_parent_cat;
} 
function get_search_products($item){
    $list_product = db_fetch_array("SELECT * FROM `tbl_products` WHERE CONVERT(`product_title` USING utf8) LIKE '%$item%' OR  CONVERT(`product_code` USING utf8) LIKE '%$item %'");
    return $list_product;

}
function get_list_cat_all_search($value){
    $sql = "SELECT DISTINCT `parent_cat` FROM `tbl_products` WHERE CONVERT(`product_title` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %'";
    $result = db_fetch_array($sql);
    return $result;
}

//
function get_list_all_products_search_by_cat($parent_cat, $value, $order_by =''){
    $sql = "SELECT * FROM `tbl_products` WHERE `parent_cat` = '{$parent_cat}' AND (CONVERT(`product_title` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %') $order_by ";
    $result = db_fetch_array($sql);
    return $result;
}
function get_cat_id_by_cat($cat){
    $data = db_fetch_assoc("SELECT `cat_id` FROM `tbl_produc_cat` WHERE `title` = '{$cat}'");
    return $data['cat_id'];
}