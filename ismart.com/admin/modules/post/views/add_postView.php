<?php get_header();
  $list_cat = list_cat();
//   show_array($list_cat);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <i><?php echo form_error('add_post');?></i>
                        <label for="title">Tiêu đề</label>
                        <?php echo form_error('title'); ?>
                        <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title']; ?>" >
                        <label for="title">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug'); ?>
                        <input type="text" name="slug" id="slug" value="<?php if(!empty($_POST['slug'])) echo $_POST['slug']; ?>">
                        <label for="post-content">Nội dung bài viết</label>
                        <?php echo form_error('post-content'); ?>
                        <textarea name="post-content" id="post-content" class="ckeditor"> <?php if(!empty($_POST['post-content'])) echo $_POST['post-content']; ?></textarea>
                        <label for="desc">Mô tả</label>
                        <?php echo form_error('desc'); ?>
                        <textarea name="desc" id="desc" class="ckeditor" ><?php if(!empty($_POST['desc'])) echo $_POST['desc']; ?></textarea>
                        <label>Hình ảnh</label>
                        <?php echo form_error('upload_image');?>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/upload/post/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo $_FILES['file']['name'];} else{ echo 'img-thumb.png';}?>">
                        </div>
                        <label>Danh mục cha</label>
                        <?php echo form_error('category'); ?>
                        <select name="category">
                            <option value="">---Chọn Danh mục---</option>
                            <?php 
                                foreach ($list_cat as $item){
                                    ?>
                                    <option value="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>