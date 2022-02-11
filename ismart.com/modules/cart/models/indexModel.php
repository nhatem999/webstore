<?php
//=============
//MENU
//=============
// get info menu
function get_info_menu($field, $menu_id){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    return  $info_menu_id[$field];
}

function get_info_product($product_id){
    $info_product_id = db_fetch_row("SELECT*FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id;
    }
}
function get_matp_by_province($province){
    $query = db_fetch_assoc("SELECT `matp` FROM `tbl_province` WHERE `name`='{$province}'");
    return $query['matp'];
}
function get_matp_by_district($district){
    $query = db_fetch_assoc("SELECT `maqh` FROM `tbl_district` WHERE `name`='{$district}'");
    return $query['maqh'];
}
function insert_order($data){
    db_insert('tbl_order', $data);
}
function insert_product_order($data){
    db_insert('tbl_product_order', $data);
}
?>