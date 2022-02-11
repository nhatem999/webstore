<?php
function construct(){
    load_model('index');
    load('lib','validation','data_tree');
    load('helper','url');
    load('helper','slug');
    load('helper','image');
    load('helper', 'format');
    
}
//===============
//  INDEX  MENU
//===============
function indexAction(){
    global $error, $title_menu,$menu_url_static,$menu_order;
    if(isset($_POST['sm_add'])){
        $error = array();
    
        if(empty($_POST['title'])){
            $error['title'] = "(*) Bạn cần nhập tên menu";
        }else{
            $title_menu = $_POST['title'];
        }
        if(empty($_POST['url_static'])){
            $error['url_static'] = "(*) Bạn cần nhập đường dẫn tĩnh";
        } else {
            if (is_exists('tbl_menus', 'slug', $_POST['url_static'])) {
                $error['url_static'] = '(*) Slug đã tồn tại';
            } else {
                $menu_url_static = create_slug($_POST['url_static']);
            }
        }
        if(empty($_POST['menu_order'])){
            $error['menu_order'] = "Bạn cần nhập thứ tự";
        }
        else {
            if(is_number($_POST['menu_order'])){
                $menu_order = $_POST['menu_order'];
                if (is_exists('tbl_menus', 'menu_order',  $menu_order)) {
                    $list_menus = db_fetch_array("SELECT* FROM `tbl_menus`");
                    foreach($list_menus as $menu){
                        if($menu['menu_order']>= $menu_order){
                            $menu['menu_order']++;
                            update_menu($menu, $menu['menu_id']);
                        }
                    }
                    
                }
            } else{
                $error['menu_order'] = '(*) Số thứ tự chưa đúng định dạng';
            }     
        }
        if(empty($error)){

            $data = array(
                'menu_title' => $title_menu,
                'menu_url_static' =>$menu_url_static,
                'menu_order'=> $menu_order,
    
            );
            add_menu($data);
       
            
            $error['menu'] = 'Thêm menu mới thành công';
          
        }
    
    }
    
    load_view('menu');
}
//===============
//  ADD  MENU
//===============
function add_menuAction(){
    global $error, $title_menu,$menu_url_static,$menu_order;
    if(isset($_POST['sm_add'])){
        $error = array();
    
        if(empty($_POST['title'])){
            $error['title'] = "(*) Bạn cần nhập tên menu";
        }else{
            if(is_exists('tbl_menus','menu_title',$_POST['title'])){
                $error['title'] = 'Tên đã tồn tại';
            }else{
                $title_menu = $_POST['title'];
            } 
        }
        if(empty($_POST['url_static'])){
            $error['url_static'] = "(*) Bạn cần nhập đường dẫn tĩnh";
        }else{
           
            if(is_exists('tbl_menus','menu_url_static',$_POST['url_static'])){
                $error['url_static'] = '(*) Đường dẫn đã tồn tại';
            }else{
                $menu_url_static = $_POST['url_static'];
            }
        }
        if(empty($_POST['menu_order'])){
            $error['menu_order'] = "Bạn cần nhập thứ tự";
        }
        else {
            if(is_number($_POST['menu_order'])){
                $menu_order = $_POST['menu_order'];
                if (is_exists('tbl_menus', 'menu_order',  $menu_order)) {
                    $list_menus = db_fetch_array("SELECT* FROM `tbl_menus`");
                    foreach($list_menus as $menu){
                        if($menu['menu_order']>= $menu_order){
                            $menu['menu_order']++;
                            update_menu($menu, $menu['menu_id']);
                        }
                    }
                    
                }
            } else{
                $error['menu_order'] = '(*) Số thứ tự chưa đúng định dạng';
            }     
        }
        if(empty($error)){

            $data = array(
                'menu_title' => $title_menu,
                'menu_url_static' =>$menu_url_static,
                'menu_order'=> $menu_order,
    
            );
            add_menu($data);
            
            
            $error['menu'] = 'Thêm menu mới thành công';
          
        }
    
    }
    
    load_view('menu');
}
//======================
//UPDATE-MENU
//======================

function update_menuAction(){
    global $error, $title, $product_id, $page_slug, $old_page_slug,$old_product_id, $url_static, $old_url_static, $post_id, $old_post_id, $menu_order, $old_menu_order, $data, $list_menu, $menu;
    $menu_id = $_GET['menu_id'];
    if (isset($_POST['btn-update-menu'])) {
        $error = array();
        $data = array();
        // check title post
        if(empty($_POST['title'])){     
            $error['title'] = '(*) Bạn cần nhập tiêu đề menu';
        } else{
            $old_title = get_info_menu('menu_title', $menu_id);
            if($_POST['title'] == $old_title){
                $data = array(
                    'menu_title' => '',
                );
                update_menu($data, $menu_id);
            }
            if(is_exists('tbl_menus', 'menu_title', $_POST['title'])){
                $error['title'] = '(*) Tiêu đề menu đã tồn tại';
            } else{
                $title = $_POST['title'];
                $data['menu_title'] = $title;
            }
        }
        // check url_static
        if (empty($_POST['url_static'])) {
            $error['url_static'] = '(*) Bạn cần nhập đường dẫn tĩnh';
        } else {
            $old_url_static = get_info_menu('menu_url_static', $menu_id);
            $url_static = $_POST['url_static'];
            $data['menu_url_static'] = $url_static;

        }

        // check page slug
        if (!empty($_POST['page_slug'])) {
            $old_page_slug = get_info_menu('page_slug', $menu_id);
            $page_slug = $_POST['page_slug'];
            $data['page_slug'] = $page_slug;
        }

        // check product cat slug
        if (!empty($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $old_product_id = get_info_menu('product_id', $menu_id);
            $data['product_id'] = $product_id;
        }

        // check post cat slug
        if (!empty($_POST['post_id'])) {
            $post_id = $_POST['post_id'];
            // $data['menu_id'] = $menu_id;
            $old_post_id = get_info_menu('post_id', $menu_id);
            $data['post_id'] = $post_id;
        }

        // check parent cat
        // if (empty($_POST['parent_id'])) {
        //     $parent_id = 0;
        // } else {
        //     $parent_id = $_POST['parent_id'];
        // }

        // check menu order
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = '(*) Bạn cần nhập số thứ tự';
        } else {
            if(is_number($_POST['menu_order'])){
                $menu_order = $_POST['menu_order'];
                // $data['menu_order'] = $menu_order;
                $old_menu_order = get_info_menu('menu_order', $menu_id);
            } else{
                $error['menu_order'] = '(*) Số thứ tự chưa đúng định dạng';
            }     
        }
        // check not change
        if(($title ==  $old_title) && ($url_static == $old_url_static) && ($page_slug == $old_page_slug) && ($product_id == $old_product_id) && ($post_id == $old_post_id) && ($menu_order == $old_menu_order)){
            $data = array(
                'menu_title' => $old_title,
                'menu_url_static' => $old_url_static,
            );
            update_menu($data, $menu_id);
            $error['menu'] = "Menu chưa có thay đổi gì!";
        }
        // check not error
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                if (is_exists('tbl_menus', 'menu_order',  $menu_order)) {
                    $list_menus = db_fetch_array("SELECT* FROM `tbl_menus`");
                    foreach($list_menus as $menu){
                        if($menu['menu_order'] >= $menu_order && $menu['menu_order'] <= $old_menu_order){
                            $menu['menu_order']++;
                            update_menu($menu, $menu['menu_id']);
                        }
                        if($menu['menu_order'] <= $menu_order && $menu['menu_order'] >= $old_menu_order){
                            $menu['menu_order']--;
                            update_menu($menu, $menu['menu_id']);
                        }
                    }
                    $data['menu_order'] = $menu_order;
                } else {
                    $data['menu_order'] = $menu_order;
                }
                update_menu($data, $menu_id);
                $error['menu'] = 'Cập nhật menu thành công';
            } else{
                $error['menu'] = "Bạn không có quyền thực hiện chức năng này";
            }
        }
    }
    load_view('update_menu');
}
//======================
// DELETE-MENU
//======================
function delete_menusAction(){
    $menu_id = $_GET['menu_id'];
    $menu_order = get_info_menu('menu_order', $menu_id);
    delete_menu($menu_id);
    $list_menus = db_fetch_array("SELECT* FROM `tbl_menus`");
    foreach($list_menus as $menu){
        if($menu['menu_order'] > $menu_order){
            $menu['menu_order']--;
            update_menu($menu, $menu['menu_id']);
        }
    }
    load_view('update_menu');
}
//======================
// APPLY-MENU
//======================
function apply_menusAction(){
    if(isset($_POST['sm_action'])){
        Global $error;
        if(is_login() && check_role($_SESSION['user_login']) == 1){
            $error = array();
            if(!empty($_POST['checkItem'])){
                $list_menu_id = $_POST['checkItem'];
            }
            if(!empty($_POST['actions'])){
                if($_POST['actions'] == 1){
                    if(isset($_POST['checkItem'])){
                        foreach($list_menu_id as $menu_id){
                        delete_menu($menu_id);  
                        }
                        load_view('menu');
                    } else{
                        $error['select'] = "Bạn chưa lựa chọn menu cần áp dụng";
                        load_view('menu');
                    }
                }
            } else{
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                load_view('menu');
            }
        } else{
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            load_view('menu');
        }
    }
}
