<form role = "search" method="get" class = "searchform group" action="<?php echo home_url('/'); ?>">
    <div class = "formwrapper formwrapper-field">
        <input type="search" class = "search-field" value="<?php echo get_search_query() ?>" name="s" 
        title = "<?php echo esc_attr_x('search for:', 'label' ) ?>" placeholder="pepe "/>
        </label>
        <button class="search-button">
            <img style="width:20px; height:20px;" class = "submitbutton" alt="Busqueda" src ="<?php echo get_template_directory_uri(); ?>/img/busqueda.png">
        </button>
    </div>
</form>