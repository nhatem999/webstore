<?php
# get info product
function get_info_menu($field, $menu_id){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    return  $info_menu_id[$field];
}
function get_info_product($field, $product_id){
    $info_product_id = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id[$field];
    }
}

// # get product by parent cat
function get_product_by_parent_cat($parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}') $order_by");
    return $list_product_by_parent_cat;
} 
// # get product by parent cat unseted
function get_product_by_parent_cat_unseted($product_id, $parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_id` != '{$product_id}' AND `parent_cat` = '{$parent_cat}' OR `brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}' $order_by");
    return $list_product_by_parent_cat;
} 

# get product by cat_id
function get_products_by_cat_id($cat_id){
    $cat = db_fetch_assoc("SELECT `title` FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
    $data = db_fetch_array("SELECT* FROM `tbl_products` WHERE `parent_cat` = '{$cat['title']}' OR `brand` = '{$cat['title']}' OR `product_type` = '{$cat['title']}'");
    if(!empty($data)){
        return $data;
    }
}
//===============
// SEARCH
//===============
// get_list_cat_all_search
function get_list_cat_filter($value){
    $sql = "SELECT DISTINCT `parent_cat` FROM `tbl_products` WHERE CONVERT(`product_title` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '% $value %'";
    $result = db_fetch_array($sql);
    return $result;
}
//
function get_list_product_filter_by_cat($data, $cat){
    $result = array();
    if(!empty($data)){
        foreach($data as $item){
            if($item['parent_cat'] == $cat || $item['brand'] == $cat || $item['product_type'] == $cat){
                $result[] = $item;
            }
        }
        if(!empty($result)){
            return $result;
        }
    }
    
}
function get_product($start =1 , $num_per_page = 5 ,$where = ""){
    if(!empty($where))
         $where = "WHERE {$where}";
    $list_page =db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT {$start},{$num_per_page} ");
    return $list_page;
}
function get_pagging($num_page, $page, $cat_id){
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
    if($page > 1){
        $page_prev = $page-1;
        $str_pagging .= "<li><a class='number-page' cat_id='$cat_id' ><<</a></li>";
    }
    for($i = 1; $i <= $num_page; $i++){
       $active = "";
       if($page == $i){
           $active = "class = 'active-num-page'";
       }
       $str_pagging .= "<li {$active}><a class='number-page' cat_id='$cat_id'>$i</a></li>";
    }
    if($page < $num_page){
        $page_next = $page+1;
        $str_pagging .= "<li><a class='number-page' cat_id='$cat_id'>>></a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}