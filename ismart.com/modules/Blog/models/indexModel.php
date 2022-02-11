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