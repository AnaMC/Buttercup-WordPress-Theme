<?php
// Custom post type

function product_post_custom(){

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        // 'custom-fields',
        'comments'
    );
    
    $labels = array(
        'name' => _x('Products', 'plural'),
        'singular_name' => _x('Product', 'singular'),
        'menu_name' => _x('Products', 'admin menu'),
        'name_admin_bar' => _x('Products', 'admin bar'),
        'add_new' => _x('Add new', 'add new'),
        //
        'add_new_item' => __('Add new product'),
        'new_item' => __('New product'),
        'edit_item' => __('Edit product'),
        'view_item' => __('View product'),
        'all_items' => __('All products'),
        'search_items' => __('Search products'),
        'not_found' => __('No product found.')
    );
    
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5
    );
    
    register_post_type('product_post', $args);
}
add_action('init', 'product_post_custom');

function add_product_post_metabox(){
     $screens = array ('product_post');
     foreach ( $screens as $screen ){
         add_meta_box(
                'product_post_metabox',
                __('Products Post Details'),
                'add_fields_metabox',
                $screen,
                'normal',
                'default'
             );
     }
 }
 add_action('add_meta_boxes', 'add_product_post_metabox');
 
 function add_fields_metabox($post){
    wp_nonce_field(basename(__FILE__),'product_metabox_nonce');
    
    $title       = get_post_meta($post->ID, 'product_title', true);
    $description = get_post_meta($post->ID, 'product_description', true);
    $ingredients = get_post_meta($post->ID, 'product_ingredients', true);
    $allergens   = get_post_meta($post->ID, 'product_allergens', true);
    $price       = get_post_meta($post->ID, 'product_price', true);
        
    ?>
    <label for="product_title" style="font-weight:600">Title</label><br>
    <input type="text" id="product_title" name="product_title" style="margin-bottom:10px" value="<?php echo $title ?>" >
    
    <br>
    
    <label for="product_price">Price</label><br>
    <input type="text" id="product_price" name="product_price" style="margin-bottom:10px" value="<?php echo $price ?>" >
    
    <br>
    
    <label for="product_description">Description</label><br>
    <input type="text" id="product_description" name="product_description" style="width:100%;margin-bottom:10px" value="<?php echo $description ?>">
    
    <br>
    
    <label for="product_ingredients">Ingredients</label><br>
    <input type="text" id="product_ingredients" name="product_ingredients" style="width:100%;" value="<?php echo $ingredients ?>" ><br>
    <span style="font-style:italic;color:red;margin:0px 0px 5px 20px;display:block;">*Separar los ingredientes por comas.</span>
    
    <label for="product_allergens">Allergens</label><br>
    <input type="text" id="product_allergens" name="product_allergens" style="width:100%;" value="<?php echo $allergens ?>" ><br>
    <span style="font-style:italic;color:red;margin:0px 0px 5px 20px;display:block;">Separar los ingredientes por comas.</span>
    <?php
     
 }
 function save_product_post_fields ($post_id){
     
     $is_revision = wp_is_post_revision($post_id);
     $is_autosave = wp_is_post_autosave($post_id);
     $is_nonce_valid = isset($_POST['product_metabox_nonce']) && wp_verify_nonce($_POST['product_metabox_nonce'], basename(__FILE__));
     
     if($is_revision||$is_autosave||!$is_nonce_valid){ return; }
     
     $title = sanitize_text_field($_POST['product_title']);
     $description = sanitize_text_field($_POST['product_description']);
     $ingredients = sanitize_text_field($_POST['product_ingredients']);
     $allergens = sanitize_text_field($_POST['product_allergens']);
     $price = sanitize_text_field($_POST['product_price']);
     
     
     update_post_meta($post_id, 'product_title', $title);
     update_post_meta($post_id, 'product_description', $description);
     update_post_meta($post_id, 'product_ingredients', $ingredients);
     update_post_meta($post_id, 'product_allergens', $allergens);
     update_post_meta($post_id, 'product_price', $price);
     
 }
 add_action('save_post','save_product_post_fields');
