<?php
 include ('product-post.php');
 
function my_theme_script() {
    wp_register_script('script-jquery', get_template_directory_uri().'/vendor/jquery/jquery.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-jquery');
    
    wp_register_script('script-easing', get_template_directory_uri().'/vendor/jquery-easing/jquery.easing.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-easing');
    
    wp_register_script('script-bundle', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-bundle');
    
    wp_register_script('script-scrollreveal', get_template_directory_uri().'/vendor/scrollreveal/scrollreveal.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-scrollreveal');
    
    wp_register_script('script-magnific-popup', get_template_directory_uri().'/vendor/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-magnific-popup');
    
    wp_register_script('script-creative', get_template_directory_uri().'/js/creative.min.js', array('jquery'), null, true);
    wp_enqueue_script('script-creative');
    
    wp_register_script('script-skill', get_template_directory_uri().'/js/skill.js', array('jquery'), null, true);
    wp_enqueue_script('script-skill');
    
}
add_action( 'wp_enqueue_scripts', 'my_theme_script');

//imagen thumbails añadido
add_theme_support('post-thumbnails');

//Imagenes responsive
function insert_img_responsive($content){ //$content -> Objeto con el contenido del post
        // Modificamos $content a UTF-8
        $conten= mb_convert_encoding($document, 'HTML-ENTITIES', "UTF-8");
        // Creamos un DOM
        $document = new DOMDocument(); //Posteriormente volcaremos en este documento el nuevo modificado en UTF-8
        libxml_use_internal_errors(true);  //Como esta a true no muestra los errores por pantalla
        // Cargamos el content en el DOM
        $document->loadHTML(UTF8_decode($content));
        //Acceso a las etiquetas <img>
        $imgs = $document->getElementsByTagName('img'); //Devuelve un array de etiquetas <img>
        foreach($imgs as $img){
                $img->setAttribute('class', 'img-responsive'); //borra las clases y crea la nueva -> class ="img-responsive"
                $img->setAttribute('width', '100%');
                $img->setAttribute('height', '100%');
        }
        //Grabamos los "cálculos"
        $html=$document->saveHTML();
        return $html;
}
add_filter('the_content', insert_img_responsive);

//Widgets para Sidebar

function crea_area_widgets(){
    register_sidebar(array(
        'name' => 'Sidebar Widgets',
        'id' => 'sidebar',
        'description' => 'Sidebar Widgets Area',
        'before_widget' => '<div class = "widget %2$s">',
        'after_widget' => '</div>'
        ));
        register_sidebar(array(
        'name' => 'Footer Widgets',
        'id' => 'footer',
        'description' => 'Footer Widgets Area',
        'before_widget' => '<div class = "widget %2$s">',
        'after_widget' => '</div>'
        ));
}

add_action('widgets_init', 'crea_area_widgets');

function my_comments_form($fields){
    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $nick = $user->exists() ? $user->display-name:'';
    $req = get_option('require_name_email');
    $required = "";
    if($req){
        $required = "required";
    }
    
    $fields['author'] = '<div class="formFields"><input type="text" class="form-control" id="author" name="author" value="'. esc_attr($commenter['comment_author']) . '" size="20" placeholder="Autor" required>';
    
    $fields['email'] = '<input type="email" class="form-control" id="email" name="email" value="'. esc_attr($commenter['comment_author_email']) . '" size="20" placeholder="Email"' . $required . '>';
    
    $fields['url'] = '<input type="text" class="form-control" id="url" name="url" value="'. esc_attr($commenter['comment_author_url']) . '"placeholder="Url"  size="20"></div>';
    
    $fields['comment_field'] = '<br><textarea id="comment" name="comment" class="form-control" cols="10" rows="10" required></textarea>';
    
    return $fields;
}

add_filter('comment_form_default_fields' , 'my_comments_form');

function my_form_default($defaults){
    if(isset($defaults['comment_field'])){
        if(!is_user_logged_in()){
            $defaults['comment_field'] = '';
        }else{
            $defaults['comment_field'] = '<textarea id="comment" name="comment" class="form-control" cols="10" rows="10" required></textarea>';
        }
    }
    return $defaults;
}

add_filter('comment_form_defaults' , 'my_form_default');


function custom_comments($comment, $args, $depth){
?>
<div class= "<?php echo ($depth > 1) ? 'blog-post-comment-reply' : 'blog-post-comment'; ?>">
    <?php echo get_avatar($comment, 60, $default, 'Commenter avatar',
    array('class' => array('img-circle'))); ?>
    <span class="blog-post-comment-name"><?php comment_author(); ?>-</span>
    <?php comment_date(); echo ' at '; comment_time() ?>
    
    <?php
    comment_reply_link(
        array_merge(
            $args,
            array(
                'add_below' => $add_below,
                'depth' => $depth,
                'max_depth' => $argh['max_depth'],
                'before' => '<div class="righty"><i class="fa fa-comment"></i>&nbsp;',
                'after' => '</div>'
                )
            )
        ); ?>
        
        <p>
            <?php comment_text(); ?>
        </p>
        <!-- <?php edit_comment_link(__('(Edit)'), ' ', ''); ?> -->
</div>

<?php
}
?>


<?php
// Skills
function skills_fields($user){ ?>
   
    <h3>
        <?php _e("User skills information","blank");?>
    </h3>
    <table class="form-table">

        <tr>
            <th><label for="skill-01"><?php _e("Skill 01");?></label></th>
            <td>
                <input type="text" name="skill-01" id="skill-01" value="<?php echo esc_attr(get_the_author_meta('skill-01', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your SKILL 01 description.");?></span>
            </td>
            <th><label for="skill-11"><?php _e("Value");?></label></th>
            <td>
                <input type="text" name="skill-11" id="skill-11" value="<?php echo esc_attr(get_the_author_meta('skill-11', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your skill 01 value.");?></span>
            </td>
        </tr>

        <tr>
            <th><label for="skill-02"><?php _e("Skill 02");?></label></th>
            <td>
                <input type="text" name="skill-02" id="skill-02" value="<?php echo esc_attr(get_the_author_meta('skill-02', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your SKILL 02 description.");?></span>
            </td>
            <th><label for="skill-12"><?php _e("Value");?></label></th>
            <td>
                <input type="text" name="skill-12" id="skill-12" value="<?php echo esc_attr(get_the_author_meta('skill-12', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your skill 02 value.");?></span>
            </td>
        </tr>

        <tr>
            <th><label for="skill-03"><?php _e("Skill 03");?></label></th>
            <td>
                <input type="text" name="skill-03" id="skill-03" value="<?php echo esc_attr(get_the_author_meta('skill-03', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your SKILL 03 description.");?></span>
            </td>
            <th><label for="skill-03"><?php _e("Value");?></label></th>
            <td>
                <input type="text" name="skill-13" id="skill-13" value="<?php echo esc_attr(get_the_author_meta('skill-13', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your skill 03 value.");?></span>
            </td>
        </tr>

        <tr>
            <th><label for="skill-04"><?php _e("Skill 04");?></label></th>
            <td>
                <input type="text" name="skill-04" id="skill-04" value="<?php echo esc_attr(get_the_author_meta('skill-04', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your SKILL 04 description.");?></span>
            </td>
            <th><label for="skill-04"><?php _e("Value");?></label></th>
            <td>
                <input type="text" name="skill-04" id="skill-04" value="<?php echo esc_attr(get_the_author_meta('skill-04', $user->ID));?>" class="regular-text">
                <span class="description"><?php _e("Please enter your skill 04 value.");?></span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('edit_user_profile','skills_fields');
add_action('show_user_profile','skills_fields');

function save_skills_fields($user_id){
  
    if(!current_user_can('edit_user',user_id)){ 
        return;
    } 
    update_user_meta($user_id, 'skill-01',$_POST['skill-01']);
    update_user_meta($user_id, 'skill-11',$_POST['skill-11']);
    
    update_user_meta($user_id, 'skill-02',$_POST['skill-02']);
    update_user_meta($user_id, 'skill-12',$_POST['skill-12']);
    
    update_user_meta($user_id, 'skill-03',$_POST['skill-03']);
    update_user_meta($user_id, 'skill-13',$_POST['skill-13']);
    
    update_user_meta($user_id, 'skill-04',$_POST['skill-04']);
    update_user_meta($user_id, 'skill-14',$_POST['skill-14']);
}
add_action('personal_options_update','save_skills_fields');
add_action('edit_user_profile_update', 'save_skills_fields');

function get_author_rol ($user_id){
     // extraemos toda la info del autor
     $user_info = get_userdata( $user_id );
     return implode ( ',', $user_info -> roles );
 }


?>



