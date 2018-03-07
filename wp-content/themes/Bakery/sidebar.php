<div>
    <div class="sidebarsection section-bus">
        <h3 class="sectiontitle">Busqueda</h3>
        <div class="buscador">
            <?php get_search_form(); ?>
        </div>
    </div>
    <!--<div class="sidebarsection sidebarsection-widgets">-->
    <!--    <h3 class="sectiontitle">Widgets</h3>-->
    <!--    <h5>Tag Cloud</h5>-->
    <!--    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')) : ?>-->
    <!--    <div> sorry no exist widget </div>-->
    <!--    <?php endif; ?>-->
    <!--</div>-->
    <!--<div class="sidebarsection">-->
    <!--    <h3 class="sectiontitle">Custom Post Type</h3>-->
    <!--    <?php-->
    <!--        $args = array( 'type' => 'postbypost', 'limit' => 8, 'post_type' => 'movies_post' );-->
    <!--        wp_get_archives($args);-->
    <!--    ?>-->
    <!--</div>-->
    <div class="sidebarsection">
        <h3 class="sectiontitle text-capitalize">Last Entries</h3>
        <?php 
            $args = array( 'type' => 'postbypost', 'limit' => 5, 'before' => '<div class="a-capitalize">', 'after' =>'</div>' );
            wp_get_archives($args); 
        ?>
    </div>
    <div class="sidebarsection">
        <h3 class="sectiontitle">Archives</h3>
        <?php wp_get_archives(); ?>
    </div>
    <div class="sidebarsection sidebarsection-cat">
        <h3 class="sectiontitle ">Categories</h3>
        <?php
            $args = array ( 'title_li' => '', 'show_count' => true, 'echo' => false );
            $cats = wp_list_categories($args);
            $cats = preg_replace('/<\/a> \(([0-9]+)\)/', '</a><span class="num-cat">\\1</span>', $cats);
            echo $cats;
        ?>
    </div>
    <div class="sidebarsection sidebarsection-autor">
        <h3 class="sectiontitle sidebarsection-author">Authors</h3>
        <?php
            $args = array ( 'optioncount' => true, 'orderby' => 'post_count', 'order' => 'ASC', 'hide_empty' => false, 'echo' => false );
            $authors = wp_list_authors($args);
            $authors = preg_replace('/<\/a> \(([0-9]+)\)/', '</a><span class="num-aut">\\1</span>', $authors);
            echo $authors;
        ?>
    </div>
    <div class="sidebarsection">
        <h3 class="sectiontitle">Page</h3>
        <?php 
            wp_list_pages('title_li');
        ?>
    </div>
</div>