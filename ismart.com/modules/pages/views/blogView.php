<?php get_header(); ?>
<?php
    $id = $_GET['id'];
    $list_posts = db_fetch_array("SELECT * FROM `tbl_post`");
    // show_array($list_posts);
    $num_per_page = 5;
    # Tổng số bản ghi
    $total_row =  db_num_rows("SELECT * FROM `tbl_post` ");
   
    # So trang 
    $num_page = ceil($total_row/$num_per_page);
   
    // echo $total_row . $num_page;
    $pages = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // Trang bắt đầu
    $start = ($pages - 1) * $num_per_page;
    
    $list_post = get_post($start,$num_per_page,"");
    // show_array($list_post);
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                            if(isset($list_post) && !empty($list_post)){
                                    foreach($list_post as $item) {
                                        ?>
                        <li class="clearfix">
                            <a href="?mod=pages&action=info_post&id=<?php echo $item['post_id']?>" title="" class="thumb fl-left">
                                <img src="./admin/<?php echo $item['post_thumbnail'];?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?mod=pages&action=info_post&id=<?php echo $item['post_id']?>" title="" class="title"><?php echo $item['title'];?></a>
                                <span class="create-date"><?php echo $item['created_date'];?></span>
                                <p class="desc">
                                    <?php echo $item['post_desc'];?>
                                   
                            </p>
                            </div>
                        </li>

                        <?php
                                    }
                            } 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                <?php echo get_pagging($num_page,$pages,"?mod=pages&action=index&id={$id}") ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>