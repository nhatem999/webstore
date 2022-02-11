<?php
    global $list_cat;
     $list_cat = list_cat();
    $cat_id = $_GET['cat_id'];
    

?>
<?php get_header(); ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                    <i><?php echo form_error('add_cat'); ?></i>
                        <label for="title">Tên danh mục</label>
                        <?php echo form_error('title'); ?>
                        <input type="text" name="title" id="title" value="<?php echo get_info_post_cat('title',$cat_id) ?>">
                        <label for="title">Slug ( Friendly_url )</label>
                        <?php echo form_error('slug'); ?>
                        <input type="text" name="slug" id="slug" value="<?php echo get_info_post_cat('slug',$cat_id) ?>">
                        <label>Danh mục cha</label>
                        <?php echo form_error('parent-cat'); ?>
                        <select name="parent-cat">
                        <option value="">-- Các danh mục --</option>
                        <?php 
                            foreach ($list_cat as $item) {
                                ?>
                                <option value="<?php echo $item['cat_id'];?>"><?php echo $item['title'];?></option>
                                <?php
                            }
                        ?>
                       </select>
                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>