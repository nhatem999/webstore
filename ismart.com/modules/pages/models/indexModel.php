<?php
//=============
//MENU
//=============
// get info menu
function get_info_menu($field, $menu_id){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    return  $info_menu_id[$field];
}
function get_page($field){
    $info_page_id = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `title` = '{$field}'");
    return  $info_page_id;
}

function get_info_page($field, $page_id){
    $info_page_id = db_fetch_row("SELECT `$field` FROM `tbl_pages` WHERE `title` = '{$page_id}'");
    return  $info_page_id[$field];
}
function get_product_by_parent_cat($parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}') $order_by");
    return $list_product_by_parent_cat;
} 

# get info post
function get_info_post($field, $post_id){
    $info_post_id = db_fetch_row("SELECT `$field` FROM `tbl_post` WHERE `post_id` = '{$post_id}'");
    return  $info_post_id[$field];
}
function get_post($start =1 , $num_per_page = 5 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}

function get_pagging($num_pages,$page, $base_url ="") {
    $str_pagging ="<ul class='list-pagging clearfix'>";
    if($page > 1){
        $page_prev = $page - 1;
        $str_pagging .=" <li><a class='page' href=\"{$base_url}&page={$page_prev}\">Trước</a></li>";
    }
    for($i=1; $i<=$num_pages; $i++) {
        $active = "";
        if($i == $page){
            $active="Class='active'";
        }
        $str_pagging .= "  <li $active><a class='page' href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if($page < $num_pages){
        $page_next = $page + 1;
        $str_pagging .=" <li><a class='page' href=\"{$base_url}&page={$page_next}\">Sau</a></li>";
    }
    $str_pagging .="</ul>";
    return $str_pagging;
}