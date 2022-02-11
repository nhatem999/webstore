<?php
function db_search_all_products($value,$order_by='') {
    $sql = "SELECT * FROM `tbl_products` WHERE CONVERT(`product_title`  USING utf8) LIKE '%$value%' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %' $order_by";
    $result = db_fetch_array($sql);
    return $result;
}
function db_search_products_by_page($value, $start = 1, $num_per_page = 10){
    $sql = "SELECT * FROM `tbl_products`  WHERE CONVERT(`product_title` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %' LIMIT {$start}, {$num_per_page}";
    $result = db_fetch_array($sql);
    return $result;
}


?>