<?php
get_header();
if(isset($_GET['id'])){
    $page_id = $_GET['id'];
    $category = get_info_page('category', $page_id);
    
}
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">CHỈNH SỬA TRANG</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                      
                <form method="POST">
                        <?php echo form_error('update'); ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo get_info_page('title', $page_id); ?>">
                        <?php echo form_error('title'); ?>
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo get_info_page('slug', $page_id); ?>">
                        <?php echo form_error('slug'); ?>
                        <label for="title_post">Tiêu đề trang</label>
                        <input type="text" name="title_post" id="title_post" value="<?php echo get_info_page('title_post', $page_id); ?>">
                        <?php echo form_error('title_post'); ?>
                        <label for="desc">Mô tả ngắn</label>
                        <?php echo form_error('desc'); ?>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo get_info_page('page_desc', $page_id); ?></textarea>
                        <label for="content">Mô tả</label>
                        <?php echo form_error('content'); ?>
                        <textarea name="content" id="content" class="ckeditor"><?php echo get_info_page('page_content', $page_id); ?></textarea>
                        <label for="category"></label>
                        <?php echo form_error('category'); ?>
                        <select name="category" id="">
                            <option value="">Danh mục</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Giới thiệu') echo "selected='selected'"; ?> value="Giới thiệu">Giới thiệu</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Liên hệ') echo "selected='selected'"; ?> value="Liên hệ">Liên hệ</option>
                        </select>
                        <button type="submit" name="btn-update-pages" id="btn-update-pages">Thêm mới</button>
                    </form>
                </div>           
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>




