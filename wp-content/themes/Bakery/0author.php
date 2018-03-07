<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<?php
    $curauthor = ( get_query_var( 'author_name' )  ) ? get_user_by ( 'slug', get_query_var( 'author_name' ) ) : get_user_data( get_query_var( 'author' ) );
    $url = get_template_directory_uri()."/img/".get_the_author_meta('nickname').".jpg";
    $r = @fopen($url,'r');
    if($r == false){
        $url = get_template_directory_uri()."/img/default.jpg";
    }
?>
<div style="height:80"></div>
<div id="page-author">
<section class="bg-primary" style="background-image: url('<?= $url ?>');background-repeat:no-repeat;background-size:cover;">
    <h1 class="title-author text-white ml-4"><?=get_the_author_meta('nickname');?><br><?= get_author_rol ($curauthor -> ID); ?></h1>
</section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-12 foto-author" style="background-image: url('<?= $url ?>');background-repeat:no-repeat;background-size:cover;"></div>
            </div>
            <div class="row">
                <div class="col-12 mt-3 text-justify">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
    
                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
    
                    Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
    
                    Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8 mt-5 mb-5">
                    <div class="skillbar clearfix " data-percent="<?= the_author_meta('skill-01', $curauth->ID);?>">
                        <div class="skillbar-title" style="background: #d35400;"><span><?= the_author_meta('skill-11', $curauth->ID);?></span></div>
                        <div class="skillbar-bar" style="background: #e67e22;"></div>
                        <div class="skill-bar-percent"><?= the_author_meta('skill-1-v', $curauth->ID);?></div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="<?= the_author_meta('skill-2-v', $curauth->ID);?>">
                        <div class="skillbar-title" style="background: #2980b9;"><span><?= the_author_meta('skill-2-d', $curauth->ID);?></span></div>
                        <div class="skillbar-bar" style="background: #3498db;"></div>
                        <div class="skill-bar-percent"><?= the_author_meta('skill-2-v', $curauth->ID);?></div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="<?= the_author_meta('skill-3-v', $curauth->ID);?>">
                        <div class="skillbar-title" style="background: #2c3e50;"><span><?= the_author_meta('skill-3-d', $curauth->ID);?></span></div>
                        <div class="skillbar-bar" style="background: #2c3e50;"></div>
                        <div class="skill-bar-percent"><?= the_author_meta('skill-3-v', $curauth->ID);?></div>
                    </div> <!-- End Skill Bar -->
                    <div class="skillbar clearfix " data-percent="<?= the_author_meta('skill-4-v', $curauth->ID);?>">
                        <div class="skillbar-title" style="background: #46465e;"><span><?= the_author_meta('skill-4-d', $curauth->ID);?></span></div>
                        <div class="skillbar-bar" style="background: #5a68a5;"></div>
                        <div class="skill-bar-percent"><?= the_author_meta('skill-4-v', $curauth->ID);?></div>
                    </div> <!-- End Skill Bar -->
                </div>
            </div>
            <div class="row row-post">
            <?php
                $args = array( 
                    'posts_per_page' => 10, 
                    'author' => $curauthor -> ID, 
                    'post_type' => array ( 'post' ), 
                    'tax_query' => array ( array ( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array ( 'post-format-link', 'post-formart-quote' ), 'operator' => 'NOT IN' ) )
                );
                $posts_by_author = new WP_Query($args);
                if( $posts_by_author -> have_posts() ) : 
                    while ( $posts_by_author -> have_posts() ) : 
                        $posts_by_author -> the_post();
                        if ( has_post_thumbnail() ){$urlthumbnail = get_the_post_thumbnail_url();}
                        else { $urlthumbnail = get_template_directory_uri() . "/img/000-000/thumbnail.jpg"; }
                        ?>
                            <div class="col-lg-4">
                                <div style="background-image: url('<?= $urlthumbnail ?>');background-repeat:no-repeat;background-size:cover; height:200px"></div>
                                <a class="post-autor" href="<?= get_the_permalink() ?>"><?= the_title(); ?></a>
                            </div>
                        <?php
                    endwhile;
                else :
                    ?> 
                        <p>todavia no tiene post el condenado</p>
                    <?php
                endif;
            ?>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php get_sidebar(); ?>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>