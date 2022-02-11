<?php
function construct(){
    load('helper','url');
    load_model('index');
}
function indexAction(){
    global $menu_title,$id;
    if(isset($_GET['id_menu'])){
        $id = $_GET['id_menu'];
      
    }
    $menu_title = get_info_menu('menu_title',$id);
  
    if($menu_title == 'Giới thiệu'){
        load_view('home');
    }
    if($menu_title == 'Liên hệ'){
        load_view('commend');
    }
    if($menu_title == 'Blog'){
        load_view('blog');
    }
    // if($menu_title == 'Sản phẩm'){
    //     load_view('product');
    // }
    // if($menu_title == 'Trang chủ'){
    //     load_view('home');
    // }
 
}
function info_postAction(){
    $id = $_GET['id'];
    load_view('post');
}
function detailAction(){
    load_view('index');
}