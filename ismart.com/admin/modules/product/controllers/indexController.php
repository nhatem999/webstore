<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation','data_tree');
    load('helper','url');
    load('helper','slug');
    load('helper','image');
}

function indexAction() {
    
    load_view('pageIndex');
}

function add_productAction()
{
    
    global $error, $title, $product_code, $product_price_new, $num_product, $product_price_old, $slug, $content, $desc, $product_thumb, $product_status, $parent_cat, $data, $creator, $type, $size;
    if (isset($_POST['btn-add-product'])) {
       
        $error = array();
        // check title post
        if (empty($_POST['title'])) {
            $error['title'] = '(*) Bạn cần nhập tên sản phẩm';
        } else {
            if (is_exists('tbl_products', 'product_title', $_POST['title'])) {
                $error['title'] = '(*) Tên sản phẩm đã tồn tại';
            } else {
                $title = $_POST['title'];
            }
        }
        // check product code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = '(*) Bạn cần nhập mã sản phẩm';
        } else {
            if (is_exists('tbl_products', 'product_code', $_POST['product_code'])) {
                $error['product_code'] = '(*) Mã sản phẩm đã tồn tại';
            } else {
                $product_code = $_POST['product_code'];
            }
        }
        // check product price new
        if (empty($_POST['price_new'])) {
            $error['price_new'] = '(*) Bạn cần nhập giá mới của sản phẩm';
        } else {
            if(is_number($_POST['price_new'])){
                $product_price_new = $_POST['price_new'];
            } else{
                $error['price_new'] = '(*) Bạn cần nhập giá mới đúng định dạng số';
            }
        }
        // check product price old
        if (!empty($_POST['price_old'])) {
            if(is_number($_POST['price_old'])){
                $product_price_old = $_POST['price_old'];
            } else{
                $error['price_old'] = '(*) Bạn cần nhập giá cũ đúng định dạng số';
            }
        }
        // check num_product
        if (empty($_POST['num_product'])) {
            $error['num_product'] = '(*) Bạn cần nhập số lượng sản phẩm';
        } else {
            if(is_number($_POST['num_product'])){
                $num_product = $_POST['num_product'];
            } else{
                $error['num_product'] = '(*) Bạn cần nhập số lượng đúng định dạng';
            }
        }
        // check slug
        if (empty($_POST['slug'])) {
            $error['slug'] = '(*) Bạn cần nhập đường link thân thiện';
        } else {
            if (is_exists('tbl_products', 'slug', $_POST['slug'])) {
                $error['slug'] = '(*) Slug đã tồn tại';
            } else {
                $slug = create_slug($_POST['slug']);
            }
        }
        // check desc post
        if (empty($_POST['desc'])) {
            $error['desc'] = '(*) Bạn cần nhập mô tả ngắn sản phẩm';
        } else {
            $desc = $_POST['desc'];
        }
        // check post content
        if (empty($_POST['content'])) {
            $error['content'] = '(*) Bạn cần nhập chi tiết sản phẩm';
        } else {
            $content = $_POST['content'];
        }
        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "(*) Bạn chưa upload tệp";
        }
        // check parent cat
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "(*) Không được bỏ trống danh mục sản phẩm";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        // check brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "(*) Không được bỏ trống thương hiệu sản phẩm";
        } else {
            $brand = $_POST['brand'];
        }
        // check type
        if (!empty($_POST['type'])) {
            $product_type = $_POST['type'];
        }
        // check not error
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $product_status = 'Approved';
            } else {
                $product_status = 'Waitting...';
            }
            $product_thumb = upload_image('public/images/upload/products/', $type);
            $creator =  get_admin_info($_SESSION['user_login']);
            $data = array(
                'product_title' => $title,
                'slug' => $slug,
                'product_code' => $product_code,
                'product_price_new' => $product_price_new,
                'num_product'=> $num_product,
                'product_content' => $content,
                'product_desc' => $desc,
                'product_thumb' => $product_thumb,
                'product_status' => $product_status,
                'parent_cat' => $parent_cat,
                'brand' => $brand,
                'creator' => $creator,
                'created_date' => date('d/m/y h:m'),
            );
            if (!empty($product_price_old)) {
                $data['product_price_old'] = $product_price_old;
            }
            if (!empty($product_type)) {
                $data['product_type'] = $product_type;
            }
            add_product($data);
            $error['product'] = 'Thêm sản phẩm mới thành công'."<br>"."<a href='?mod=product&controller=index&action=list_product'>Trở về danh sách sản phẩm</a>";
        }
    }
    if (isset($_POST['btn-upload-thumb'])) {
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $product_thumb = upload_image('public/images/upload/products/', $type);
            }
        } else {
            $error['upload_image'] = "Bạn chưa chọn tệp ảnh";
        }
    }
    load_view('add_product');
}
function list_productAction() {
    load('helper','format');
    load_view('list_product');

}
function update_productsAction() {
    global $data, $product_id, $error, $old_thumb, $title,$brand,$old_brand, $product_code, $old_num_product, $num_product, $product_thumb, $slug, $product_content, $product_price_new, $product_price_old, $desc, $parent_cat, $data, $editor, $type, $size, $old_title, $old_code, $old_slug, $old_product_content, $old_price_new, $old_price_old, $old_desc, $old_parent_cat;
    $product_id = $_GET['product_id'];
    if (isset($_POST['btn-update-product'])) {
        $error = array();
        // check title post
        if(empty($_POST['title'])){
            $error['title'] = "Bạn chưa nhập tiêu đề";
        }
        else{
            $old_title = get_info_product('product_title', $product_id);
            if($_POST['title'] != $old_title){
                $title = $_POST['title']; 
                if(is_exists('tbl_products', 'product_title', $_POST['title'])){
                    $error['title'] = '(*) Tên sản phẩm đã tồn tại';
                }else{
                    $data = array(
                        'product_title' => $title
                    );            
                    update_product($data , $product_id);
                }
              
            }
           
        }
        // check product_code
        if(empty($_POST['product_code'])){
            $error['product-code'] = " Bạn chưa nhập mã sản phẩm ";
        }else{
            $old_code = get_info_product('product_code', $product_id);
            if($_POST['product_code'] != $old_code ){
                $product_code = $_POST['product_code'];
                if (is_exists('tbl_products', 'product_code', $_POST['product_code'])) {
                    $error['product_code'] = '(*) Mã sản phẩm đã tồn tại';
                }
                else{
                    $data = array(
                        'product_code' => $product_code
                    );            
                    update_product($data , $product_id);
                }
               
            }
            
        }
        // Check slug
        if(empty($_POST['slug'])){
            $error['slug'] = " Bạn chưa nhập slug ";
        }else{
            $old_slug = get_info_product('slug', $product_id);
            if($_POST['slug'] != $old_slug ){
                $slug = $_POST['slug'];
                if(is_exists('tbl_products', 'slug', $_POST['slug'])){
                    $error['slug'] = '(*) Slug đã tồn tại';
                }else{
                    $data = array(
                        'slug' => $slug
                    );            
                    update_product($data , $product_id);
                }
               
            }
            
        }
        // check price_new
        if (empty($_POST['price_new'])) {
            $error['price_new'] = '(*) Bạn cần nhập giá mới của sản phẩm';
        } else {
            $old_price_new = get_info_product('product_price_new', $product_id);
            if(is_number($_POST['price_new'])){
                $product_price_new = $_POST['price_new'];
                $data = array(
                    'product_price_new' => $product_price_new
                );            
                update_product($data , $product_id);
            } else{
                $error['price_new'] = '(*) Bạn cần nhập giá mới đúng định dạng số';
            }
        }
        // check product price old
        if (!empty($_POST['price_old'])) {
            $old_price_old = get_info_product('product_price_old', $product_id);
            if(is_number($_POST['price_old'])){
                $product_price_old = $_POST['price_old'];
                $data = array(
                    'product_price_old' => $product_price_old
                );            
                update_product($data , $product_id);
            } else{
                $error['price_old'] = '(*) Bạn cần nhập giá cũ đúng định dạng số';
            }
        }
        // check product price old
        if (empty($_POST['num_product'])) {
            $error['num_product'] = '(*) Bạn cần nhập số lượng sản phẩm';
        } else {
            if(is_number($_POST['num_product'])){
                $old_num_product = get_info_product('num_product', $product_id);
                $num_product = $_POST['num_product'];
                $data = array(
                    'num_product' => $num_product,
                );            
                update_product($data , $product_id);
            } else{
                $error['num_product'] = '(*) Bạn cần nhập số lượng đúng định dạng';
            }
        }
        if(empty($_POST['desc'])){
            $error['desc'] = " Bạn chưa nhập mô tả ngắn ";
        }else{
            $old_desc = get_info_product('product_desc', $product_id);
            if($_POST['desc'] != $old_desc ){
                $desc = $_POST['desc'];
                $data = array(
                    'product_desc' => $desc
                );            
                update_product($data , $product_id);
            }
            
        }
        if(empty($_POST['content'])){
            $error['content'] = " Bạn chưa nhập nội dung ";
        }else{
            $old_product_content = get_info_product('product_content', $product_id);
            if($_POST['content'] != $old_price_new ){
                $product_content = $_POST['content'];
                $data = array(
                    'product_content' => $product_content
                );            
                update_product($data , $product_id);
            }
            
        }
        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_info_product('product_thumb', $product_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $product_thumb = upload_image('public/images/upload/products/', $type); 
                    $data = array(
                        'product_thumb' => $product_thumb
                    );            
                    update_product($data , $product_id);
                } else {
                    $product_thumb = upload_image('public/images/upload/products/', $type);
                    $data = array(
                        'product_thumb' => $product_thumb
                    );            
                    update_product($data , $product_id);
                }
            }
        } 
        if(empty($error)){
            $data = array (
                'product_title' => $title,
                'product_code' => $product_code, 
            );
        //  update_product($data , $product_id);
        }
       
    }
    load_view('update_product');
}
function search_productsAction() {
    global $error,$value;
    load('helper','format');
    load('lib','color');
    if (isset($_GET['sm_s'])) {
        if(!empty($_GET['value'])){
            $value = $_GET['value'];
            load_view('search_products');
        } else{
            $error['error'] = 'Bạn cần nhập thông tin SẢN PHẨM cần tìm kiếm!';
            load_view('list_product');
        }
    }
    
}
function result_searchAction(){
    load('helper','format');
    load('lib','color');
    global $value;
    if(!empty($_GET['value'])){
        $value = $_GET['value'];
    }
    load_view('search_products');
}

function list_catAction() {
    load_view('list_cat');
}

function delete_postAction(){
    $post_id = $_GET['post_id'];
    delete_post($post_id);
    redirect('?mod=post&controller=index&action=list_post');
}