<?= get_header(); ?>
<?= get_template_part('nav'); ?>
<?php
    the_post();
    $title       = get_post_meta($post->ID, 'product_title', true);
    $description = get_post_meta($post->ID, 'product_description', true);
    $ingredients = get_post_meta($post->ID, 'product_ingredients', true);
    $allergens   = get_post_meta($post->ID, 'product_allergens', true);
    $price       = get_post_meta($post->ID, 'product_price', true);
    
    $ingredients = explode(",", $ingredients);
    $allergens = explode(",", $allergens);
?>
<div id="single-custom">
    <div style="height:85px"></div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-6 b2">
                    <?php if(has_post_thumbnail()){
                            $postImg = get_the_post_thumbnail_url();
                        }else{
                            $postImg = get_template_directory_uri() . '/imagenes/default.jpg';
                        }
                    ?>
                    <img src="<?php echo $postImg; ?>" class="img-related"></img>
                </div>
                <div class="col-6 b3">
                    <div class="tit-0"><h1><?= the_title() ?></h1></div>
                    <div class="pri-0"><h1><?= $price ?> $</h1></div>
                    <div class="des-0"><p><?= $description; ?></p></div>
                    <div>
                        <h2>Ingredients</h2>
                        <p>
                            <?php
                                $cont=0;
                                foreach ($ingredients as $ingredient) {
                            ?>
                                <span class="span-0 span-0<?= $cont ?>"><?= $ingredient ?></span>
                            <?php
                                $cont++; 
                                }
                            ?> 
                        </p>
                    </div>
                    <div class="all-0">
                        <p>
                            <h2>Allergens</h2>
                            <?php
                                $cont=0;
                                foreach ($allergens as $allergen) {
                            ?>
                                <span class="span-0 span-0<?= $cont ?>"><?= $allergen ?>,</span>
                            <?php
                                $cont++; 
                                }
                            ?> 
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>
<?= get_footer(); ?>