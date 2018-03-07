<?php
    if(has_post_thumbnail()){
        $postImg = get_the_post_thumbnail_url();
    }else{
        $postImg = get_template_directory_uri() . '/img/default.jpg';
    }
?>
<div class="col-md-12 border-bottom pb-4">
    <img src="<?php echo $postImg; ?>" class="img-post pb-4"></img>
    <a href="<?php the_permalink(); ?>" class="tituloPost"><?php the_title();?></a>
    <span><?php the_excerpt(); ?></span>
    <div class="infoPost">
        <span><i class="fa fa-calendar" aria-hidden="true"></i><span class="WPDate">&nbsp;<?php the_time('j-m-Y'); ?></span></span>
        <span><i class="fa fa-user" aria-hidden="true"></i><span class="WPAuthor">&nbsp;<?php echo get_the_author_posts_link() ?></span></span>
        <span><i class="fa fa-comments" aria-hidden="true"></i><span class="WPComments">&nbsp;<?php echo 'No hay comentarios'; ?></span></span>
    </div>
    <div class="infoPostLeft"></div>
</div>