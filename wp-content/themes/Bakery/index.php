<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<div class="separador"></div>
<?php
$args = array(
      'posts_per_page' => 1,
      'post_type' => array ('post'),
      'tax_query'=> array(
                 array(
                 'taxonomy' => 'post_format',
                 'field' => 'slug',
                 'terms' => array(
                           'post-format-gallery',
                           'post-format-link',
                           'post-format-image',
                           'post-format-quote',
                           'post-format-audio',
                           'post-format-video'
                  ),
                  'operator' => 'NOT IN'
                 ))
);
    $custom = new WP_Query($args);
    $id = null;
    if ($custom->have_posts()):while($custom->have_posts()):$custom->the_post();
        if(has_post_thumbnail()){
            $postImg = get_the_post_thumbnail_url();
        }else{
            $postImg = get_template_directory_uri() . '/img/default.jpg';
    }
?>
<div class="img-postDestacado" style="background-image: url('<?php echo $postImg ?>');position: relative;">
    <?php
        $args = array('class' => 'photo-author-destacado');
        echo get_avatar(get_the_author_meta('ID') , 100 , null , 'foto del autor' , $args);
    ?>
</div>
<div class="container-fluid py-4">
    <div class="row justify-content-md-center">
        <div class="col-md-8 destacado-post-border">
            <a href="<?php the_permalink(); ?>" class="tituloPost"><?php the_title();?></a>
            <div class="WPexcerpt"><?php the_excerpt(); ?></div>
            <div class="infoPost">
                <span><i class="fa fa-calendar" aria-hidden="true"></i><span class="WPDate">&nbsp;<?php the_time('j-m-Y'); ?></span></span>
                <span><i class="fa fa-user" aria-hidden="true"></i><span class="WPAuthor">&nbsp;<?php echo get_the_author_posts_link() ?></span></span>
                <span><i class="fa fa-comments" aria-hidden="true"></i><span class="WPComments">&nbsp;<?php echo 'No hay comentarios'; ?></span></span>
            </div>
            <?php $id = $post->ID; endwhile;endif; wp_reset_query(); ?>
        </div>
    </div>
</div>


<div class="container">
     <div class="row">
          <div class="col-md-8">
            <?php 
                $args = array(
                    'posts_per_page' => 10,
                    'post_type' => array ('post'),
                    'post__not_in' => array($id)          
                );
                $custom = new WP_Query($args);
                if ($custom->have_posts()):while($custom->have_posts()):$custom->the_post();
            ?>
            <div class="row pb-5">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row">
                            <?php get_template_part('content', get_post_format()) ?>
                        </div>
                    </div>
                </div>
                            
            </div>
            <?php
                endwhile;endif;
                wp_reset_query();
            ?>
          </div>
          <div class="col-md-4">
                <?php
                    get_sidebar();
                ?>    
          </div>
      </div>
    </div>
    <?php 
        
        get_footer();

    ?>