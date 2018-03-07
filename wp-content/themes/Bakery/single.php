<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<?php
    the_post();
    $categorias = get_the_category();
    $post_id = $post->ID;
    $catid = array();
    foreach ( $categorias as $cat ) {
        $catid[] = $cat -> term_id;
    }
    if(has_post_thumbnail()){
        $post_img = get_the_post_thumbnail_url();
    }else{
        $post_img = get_template_directory_uri() . '/img/default.jpg';
    }
?>
<div id="single">
    <section class="bg-primary" style="background-image: url('<?php echo $post_img ?>');background-repeat:no-repeat;background-size:cover;height:400px;">
        <h1 class="text-center pt-5"><?= the_title() ?></h1>
    </section>
    <div class="container" style="padding-top:40px">
        <div class="row">
            <div class="col-lg-8 text-color-00">
                 <div><?php the_content(); ?></div>
                 <div class="">
                    <span><i class="fa fa-calendar" aria-hidden="true"></i><span class="">&nbsp;<?php the_time('j-m-Y'); ?></span></span>
                    <span><i class="fa fa-user" aria-hidden="true"></i><span class="">&nbsp;<?php echo get_the_author_posts_link() ?></span></span>
                    <span><i class="fa fa-comments" aria-hidden="true"></i><span class="">&nbsp;<?php echo 'No hay comentarios'; ?></span></span>
                </div>
                <div class="pt-4"><?php comments_template(); ?></div>
                <h1 class="pt-4 pb-3">Others Post</h1>
                <div class="row">
                <?php
                    $args = array(
                        'posts_per_page' => 3,
                        'category__in' => $catid,
                        'post__not_in' => [$post_id]  
                    );
                    $custom = new WP_Query($args);
                    $id = null;
                    if ($custom->have_posts()):while($custom->have_posts()):$custom->the_post();
                        if(has_post_thumbnail()){
                            $postImg = get_the_post_thumbnail_url();
                        }else{
                            $postImg = get_template_directory_uri() . '/imagenes/default.jpg';
                        }
                ?>
                    <div class="col-md-4">
                        <img src="<?php echo $postImg; ?>" class="img-related"></img>
                        <span><a href="<?php the_permalink(); ?>" class="linkrelated text-uppercase"><?php the_title(); ?></a></span>
                    </div>        
                <?php
                    endwhile;endif;
                    wp_reset_query();
                ?>
            </div>
            </div>
            <div class="col-lg-4"><?php get_sidebar(); ?></div>
        </div>
    </div>
</div>
<?= get_footer(); ?>