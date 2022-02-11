<?php
function construct(){
    load_model('index');
}
function indexAction(){
    $id = $_GET['menu_id'];
    global $menu_title;
    $menu_title = get_info_menu('menu_title',$id);
    load_view('contract');
}
function detailAction(){
    load_view('index');
}