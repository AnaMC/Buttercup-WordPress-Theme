<?php 
/*
        Template Name: products
*/
?>
<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<div id="page-products">

<div class="text-center" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/recursos/products.jpg');background-repeat:no-repeat;background-size:cover;">
    <div class="container" style="height:400px;">
        <div style="height:200px;"></div>
        <h1 class="text-white text-capitalize">products</h1>
    </div>
</div>
<div class="container-fluid">
    <div class="row border-left border-top" style="border-color:#ded5c8!important;">
        <?php 
            $args = array(
                'posts_per_page' => 30,
                'post_type' => array ('product_post')        
            );
            $custom = new WP_Query($args);
            $count_post=0;
            if ($custom->have_posts()):while($custom->have_posts()):$custom->the_post();
            $count_post++;
        ?>
        <?php
            if(has_post_thumbnail()){
                $postImg = get_the_post_thumbnail_url();
            }else{
                $postImg = get_template_directory_uri() . '/img/default.jpg';
            }
        ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 col-6 border-right border-bottom" style="padding:10px 10px;border-color:#ded5c8!important;">
            <a href="<?php the_permalink(); ?>" class="permalink">
                <img class="photo-product" src="<?php echo $postImg; ?>">
                <div class="">
                    <div class="text-center color-00"> <?php echo get_post_meta($post->ID, 'product_title', true); ?> </div>
                    <div class="text-center color-00"> $ <?php echo get_post_meta($post->ID, 'product_price', true); ?> </div>
                </div>
            </a>
        </div>
        <?php endwhile;endif; wp_reset_query(); ?>
    </div>
</div>

</div>
<?php get_footer(); ?>