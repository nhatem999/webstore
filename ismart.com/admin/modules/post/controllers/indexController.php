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

function add_postAction() {
    global $title,$slug,$desc,$category,$error,$content;
    
    if(isset($_POST['btn-submit'])){
        $error = array();
        if(empty($_POST['title'])){
            $error['title'] = 'Bạn chưa nhập tiêu đề';
        }
        else{
            $title = $_POST['title'];
        }
        if(empty($_POST['slug'])){
            $error['slug'] = 'Bạn chưa nhập đường link thân thiện';
        }
        else{
            $slug = create_slug($_POST['slug']) ;
        }
        if(empty($_POST['post-content'])){
            $error['post-content'] = 'Bạn chưa nhập nội dung trang';

        }
        else{
            $content = $_POST['post-content'];
        }
        if(empty($_POST['desc'])){
            $error['desc'] = 'Bạn chưa nhập nội dung trang';

        }
        else{
            $desc = $_POST['desc'];
        }
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "(*) Bạn chưa upload tệp";
        }
        if(empty($_POST['category'])){
            $error['category'] = 'Bạn chưa chọn danh mục';

        }
        else{
            $category = $_POST['category'];
        }
        // show_array($error);
        if(empty($error)){
            $creator = $_SESSION['user_login'];
            if($creator == 'admin123'){
                $post_status = 'Approve';
            }else{
                $post_status = 'Watting';
            }
            $post_thumbnail = upload_image('public/images/upload/post/', $type);
            $data = array(
                'title'=> $title,
                'slug'=> $slug,
                'post_content'=> $content,
                'post_thumbnail'=>$post_thumbnail,
                'post_desc'=> $desc,
                'parent_cat' => $category,
                'creator' =>$creator,
                'created_date'=>date("d/m/Y"),
                'post_status'=>$post_status,
            );
            
            add_post($data);
        //   show_array($data);
            $error['add_post'] = "Thêm bài viết thành công";
           
            
        }
    }
    load_view('add_post');
}
function list_postAction() {
    // $user = user_login();
    $info_user=get_info_user();
//    show_array( $info_user);

    if(isset($_POST['btn-action'])){
        global $data,$error;
      if($info_user['role']== 1){
        $error = array();
        if(!empty($_POST['checkItem'])){
            $list_post_cat_id = $_POST['checkItem'];
            // show_array($_POST['checkItem']);
        }
        if(($_POST['actions'])== 1 ) {
            if(isset($_POST['checkItem'])){
                $data = array(
                    'post_status'=> 'Approved',
                );
                foreach($_POST['checkItem'] as $post_cat_id ){
                    update_status($data, $post_cat_id); 
                    
                }
            }            
        }
        if(($_POST['actions'])== 2 ) {
            if(isset($_POST['checkItem'])){
                $data = array(
                    'post_status'=> 'Waitting ...',
                );
                foreach($_POST['checkItem'] as $post_cat_id ){
                    update_status($data, $post_cat_id); 
                    
                } 
            }            
        }
        if(($_POST['actions'])== 3 ) {
            if(isset($_POST['checkItem'])){
              
                foreach($_POST['checkItem'] as $post_cat_id ){
                    delete_post( $post_cat_id); 
                }
            }
        }
    }
    else{
              echo "Không có quyền";
          }
    }
    load_view('list_post');
}
function list_catAction(){
    
    load_view('list_cat');
}
function update_postAction() {
    global $title, $error, $category,$post_content,$slug,$post_desc,$post_thumbnail;
    $post_id = $_GET['post_id'];
    if (isset($_POST['btn-update-post'])) {
        $error = array();
       if(empty($_POST['title'])){
           $error['title'] = "Bạn chưa nhập tiêu đề";
       }else{
           $title = $_POST['title'];
       }
       if(empty($_POST['slug'])){
           $error['slug'] = "Bạn chưa nhập slug";
       }else{
           $slug = $_POST['slug'];
       }
       if(empty($_POST['post_content'])){
           $error['post-content'] = "Bạn chưa nhập nội dung";
       }else{
           $post_content = $_POST['post_content'];
       }
       if(empty($_POST['desc'])){
        $error['desc'] = "Bạn chưa nhập nội dung";
             }else{
        $post_desc = $_POST['desc'];
    }
        // check upload file
              if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            if($_FILES["file"]["name"]!=NULL)
                {

                if($_FILES["file"]["type"]=="image/jpeg"
                ||$_FILES["file"]["type"]=="image/png"
                ||$_FILES["file"]["type"]=="image/gif"
                            )
                {
                if($_FILES["file"]["size"]>1048576)
                {
                // echo "file quá nang";
                $error['image'] = "file quá nang";
                }

                // kiem tra su ton tai cua file
                elseif (file_exists("" . $_FILES["file"]["name"])) 
                {
                    $error['image'] = $_FILES["file"]["name"]." file da ton tai. ";
                }

                else{
                $post_thumbnail="";
                $path = "public/images/upload/post/"; // file luu vào thu muc chua file upload
                $tmp_name = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $type = $_FILES['file']['type']; 
                $size = $_FILES['file']['size']; 
                // Upload file
                move_uploaded_file($tmp_name,$path.$name);
                $post_thumbnail  = $path.$name;
               
                }
                }
                else {
                     $error['image']=  "file duoc chon khong hop le";
                }
                }
               
        }
        else{
            $post_thumbnail = get_info_post('post_thumbnail', $post_id);
        }

        if(empty($_POST['parent_cat'])){
            $category = get_info_post('parent_cat', $post_id);
        }else{
            $category = $_POST['parent_cat'];
        }
       if(empty($error)){
        $creator = $_SESSION['user_login'];
           $data= array(
               'title'=>$title,
               'slug'=>$slug,
               'post_content'=>$post_content,
               'post_desc'=>$post_desc,
               'post_thumbnail'=>$post_thumbnail,
                'parent_cat'=>$category,
                'creator' => $creator,
                'created_date'=>date("d/m/Y"),


           );
          
           update_post($data,$post_id);
           $error['update_post'] = "Cập nhật bài viết thành công";  
       }
    //    show_array($error);

    }
    load_view('update_post');
    
}
function delete_postAction(){
    $post_id = $_GET['post_id'];
    delete_post($post_id);
    redirect('?mod=post&controller=index&action=list_post');
}