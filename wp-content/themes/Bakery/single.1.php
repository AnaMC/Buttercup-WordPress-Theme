<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<?php 
    get_template_part('nav');
    the_post();
    $categorias = get_the_category();
    $post_id = $post->ID;
    $catid = array();
    foreach ( $categorias as $cat ) {
        $catid[] = $cat -> term_id;
    }
?>
<div class="separador"></div>
<?php
    if(has_post_thumbnail()){
        $postImg = get_the_post_thumbnail_url();
    }else{
        $postImg = get_template_directory_uri() . '/imagenes/default.jpg';
    }
?>
<div class="img-postDestacado singleImage" style="background-image: url('<?php echo $postImg ?>');">
    <span class="tituloSingle"><?php the_title(); ?></span>
</div>
<div class="container pt-5">
    <div class="row">
        <div class="col-md-8">
            <br>
            <div class="infoPost">
                <span><i class="fa fa-calendar" aria-hidden="true"></i><span class="WPDate">&nbsp;<?php the_time('j-m-Y'); ?></span></span>
                <span><i class="fa fa-user" aria-hidden="true"></i><span class="WPAuthor">&nbsp;<?php echo get_the_author_posts_link() ?></span></span>
                <span><i class="fa fa-comments" aria-hidden="true"></i><span class="WPComments">&nbsp;<?php echo 'No hay comentario'; ?></span></span>
            </div>
            <br>
            <hr>
            <?php the_content();?>
            <div class="row">
                <div class="col-md-12">
                    <span>Publicación relacionada</span>
                </div>
            </div>
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
                        <span><a href="<?php the_permalink(); ?>" class="linkrelated"><?php the_title(); ?></a></span>
                    </div>        
                <?php
                    endwhile;endif;
                    wp_reset_query();
                ?>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $args = array(
                            'p' => $post_id
                        );
                        $custom = new WP_Query($args);
                        if ($custom->have_posts()):while($custom->have_posts()):$custom->the_post();
                            //the_title();
                            ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <?php
                                        $args = array('class' => 'photo_author');
                                        echo get_avatar(get_the_author_meta('ID') , 96 , null , 'foto del autor' , $args);
                                    ?>
                                </div>
                                <div class="col-md-10">
                                    <span><?php echo get_the_author_meta('description') ?></span>
                                </div>
                            </div>
                            <hr>
                            <?php
                                comments_template();
                            ?>
                            <?php
                        endwhile;endif;
                        wp_reset_query();
                    ?>
                </div>
            </div>
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