<form role="search" method="get" class="searchform group" action="<?php echo home_url ('/'); ?>">
    <div class="search-s">
        <input type="search" class="search-field" value="<?= get_search_query(); ?>" name="s" title="<?= esc_attr_x( 'Search for:', 'label' )?>" placeholder="Search..."/>
        <input type="submit" value="Search" />
    </div>
</form>
    