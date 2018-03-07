<div class = "my_sidebar">
<section>
    <div class="sidebarSection">
        <h3 class="sectionTitle">Busqueda:</h3>
        <?php get_search_form(); ?>
    </div>
        <div class="sidebarSection">
        <h3 class="sectionTitle">TAG CLOUD Widgets:</h3>
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')) : ?>
        <div class = "warning">Sorry, no widgets installed for this theme. Go to the admin area and drag your widgets into the sidebar.</div>
        <?php endif; ?>
    </div>
        <div class="sidebarSection">
        <h3 class="sectionTitle">Ultimas entradas:</h3>
        <?php 
        $args = array(
            'type'=> 'alpha',
            'limit' => 5);
            
        wp_get_archives($args); 

        ?>
    <div class="sidebarSection">
        <h3 class="sectionTitle">Archivos:</h3>
        <?php wp_get_archives(); ?>
    </div>
    </div>
        <div class="sidebarSection">
        <h3 class="sectionTitle">Categorias:</h3>
        <?php
        $args = array (
            'title_li' => '',
            'show_count' => true,
            'echo' => false
            );
        $cats = wp_list_categories($args); 
        $cats = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class = "badge">\\1</span></a>',$cats);
         echo $cats;
        ?>
    </div>
        <div class="sidebarSection">
        <h3 class="sectionTitle">Autores:</h3>
        <?php
        $args = array (
            'echo' => false,
            'optioncount' => true,
            'orderby' => 'post_count',
            'order' => 'ASC',
            'hice_empty' => false
            );
        $autores = wp_list_authors($args); 
        $autores = preg_replace('/<\/a> \(([0-9]+)\)/', '<span class = "badge">\\1</span></a>', $autores);
        echo $autores;
        ?>
    </div>
            <div class="sidebarSection">
        <h3 class="sectionTitle">Paginas:</h3>
        <?php
            wp_list_pages();
        ?>
    </div>
</section>
</div>