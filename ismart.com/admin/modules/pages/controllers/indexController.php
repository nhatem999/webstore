<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib','validation');
    load('helper','url');
    load('helper','slug');
}

function indexAction() {
    
    load_view('pageIndex');
}

function add_pageAction() {
    global $title,$slug,$desc,$category,$error,$title_post,$content;
    if(isset($_POST['btn-submit'])){
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
            $slug = create_slug($_POST['slug']);
        }
        if(empty($_POST['title_post'])){
            $error['title_post'] = 'Bạn chưa nhập tiêu đề';

        }
        else{
            $title_post = $_POST['title_post'];
        }
        if(empty($_POST['desc'])){
            $error['desc'] = 'Bạn chưa nhập mô tả ngắn  ';

        }
        else{
            $desc = $_POST['desc'];
        }
        if(empty($_POST['content'])){
            $error['content'] = 'Bạn chưa nhập nội dung bài viết  ';

        }
        else{
            $content = $_POST['content'];
        }
        if(empty($_POST['category'])){
            $error['category'] = 'Bạn chưa chọn danh mục';

        }
        else{
            $category = $_POST['category'];
        }

        if(empty($error)){
            $creator = $_SESSION['user_login'];
            $data = array(
                'title'=> $title,
                'slug'=> $slug,
                'title_post' => $title_post,
                'page_desc' => $desc,
                'page_content'=> $content,
                'category' => $category,
                'creator' =>$creator,
                'created_date'=>date("d/m/Y"),

            );
            //  show_array($data);
            add_pages($data);
            $error['add_page'] = "Thêm trang mới thành công";
        }
    }
    load_view('add_page');
}

function update_pageAction() {
    $page_id = $_GET['id'];
    global $title,$slug,$desc,$category,$error,$title_post,$content;
    if(isset($_POST['btn-update-pages'])){
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
            $slug = create_slug($_POST['slug']);
        }
        if(empty($_POST['title_post'])){
            $error['title_post'] = 'Bạn chưa nhập tiêu đề';

        }
        else{
            $title_post = $_POST['title_post'];
        }
        if(empty($_POST['desc'])){
            $error['desc'] = 'Bạn chưa nhập mô tả ngắn  ';

        }
        else{
            $desc = $_POST['desc'];
        }
        if(empty($_POST['content'])){
            $error['content'] = 'Bạn chưa nhập nội dung bài viết  ';

        }
        else{
            $content = $_POST['content'];
        }
        if(empty($_POST['category'])){
            $error['category'] = 'Bạn chưa chọn danh mục';

        }
        else{
            $category = $_POST['category'];
        }

        if(empty($error)){
            $creator = $_SESSION['user_login'];
            $data = array(
                'title'=> $title,
                'slug'=> $slug,
                'title_post' => $title_post,
                'page_desc' => $desc,
                'page_content'=> $content,
                'category' => $category,
                'creator' =>$creator,
                'created_date'=>date("d/m/Y"),

            );
            //  show_array($data);
            update_page($data,$page_id);
            $error['update'] = "Cập nhật trang thành công";
        }
    }
    load_view('update_page');
}
function delete_pageAction() {
    $id = $_GET['id'];
    delete_page($id);
    redirect('?mod=pages&controller=index&action=index');
}   