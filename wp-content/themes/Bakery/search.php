<?php get_template_part('nav'); 
    get_header()?>
?>
<?php


if(have_posts()){
    $total = $wp_the_query->found_posts;
    if($total > 1){
        $result = 'Ha encontrado: ' . $total . ' entradas';
    }else{
        $result = 'Ha encontrado: ' . $total . ' entrada';
    };
    
}else{
        $result = 'No hay entrada';
    }
    
    
?>

<section>
      <div class="container">
       <h2 class="text-center text-uppercase text-secondary mb-0">Ultimas entradas</h2>
        <hr class="star-dark mb-5">
        <div class="row">
         <div class="col-md-12 numPost"><?php echo $result; ?> </div></br></br>
         <div class="col-md-12">
                 <?php while (have_posts()) : the_post();
                 get_template_part('content','list');
                 endwhile;
                  echo '</tbody></table>';
                    // Previous/next page navigation.
                    echo '<div class="text-center"><hr>';
                    the_posts_pagination( array(
                        'prev_text'          => 'Previous page' ,
                        'next_text'          => 'Next page' ,
                        'title_li' => null,
                        'before_page_number' => '<span class="meta-nav screen-reader-text"> </span>',
                    ) );
                    echo '</div><br/><br /><br />';
            ?>
         </div>
      </div>
      </div>
</section>
<?php
    get_footer()?>
<?
