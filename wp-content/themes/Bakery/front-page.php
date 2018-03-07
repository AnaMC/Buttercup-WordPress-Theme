<?= get_header(); ?>
<?= get_template_part('nav'); ?>

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <span class="titulo-princilal">PURE INGREDIENTS MIXED TOGETHER in THOUGHTFUL and CREATIVE WAYS</span>
              <!--<h1 style="font-family: 'Roboto', sans-serif;">fdsfdsf</h1>-->
            </h1>
          </div>
          <div class="col-lg-8 mx-auto">
            <!--<p class="text-faded mb-5">Start Bootstrap can help you build better websites using the Bootstrap CSS framework! Just download your template and start going, no strings attached!</p>-->
          </div>
        </div>
      </div>
    </header>
  
    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">All our products</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-birthday-cake text-primary mb-3"></i>
              <div class="" style="background-image:url(''),background-reapeat:no-repeat;"></div>
              <h3 class="mb-3">Cake</h3>
              <p class="text-muted mb-0">The best cakes for your most important events</p>
            </div>
          </div>
          <!--Añadido (col-lg-3) -->
            <div class="col-lg-2 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <!--<i class="fas fa-4x fa-snowflake text-primary mb-3 sr-icons"></i>-->
              <i class="fas fa-snowflake fa-4x text-primary mb-3"></i>
              <h3 class="mb-3">Christmas</h3>
              <p class="text-muted mb-0">Products for the most special Christmas holidays</p>
            </div>
          </div>
          <!---->
          <div class="col-lg-2 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-cloud text-primary mb-3"></i>
              <h3 class="mb-3">Bread</h3>
              <p class="text-muted mb-0">Artisan bread made with ecological products</p>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-coffee text-primary mb-3"></i>
              <h3 class="mb-3">Tea</h3>
              <p class="text-muted mb-0">We'll make tea time exquisite.</p>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-heart text-primary mb-3"></i>
              <h3 class="mb-3">Otros</h3>
              <p class="text-muted mb-0">Wide selection of outstanding products</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-primary blue-back" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-justify">
            <h2 class="section-heading text-white text-center titulo-filosofia">Our philosophy</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4 descripcion-filosofia">
              Conceived, built and run by lovers and purveyors of food, Buttercup Bakery transports the curious on a delectable journey of mystery and desire that will elevate the baked good to a piece of comforting decadence that can be experienced every day.
              In Urdu, the word mazedar describes the taste essence of food, its flavor and magic that make it delicious. This one word captures the life of a taste experience, unique to each person but cohesive in its stories. It represents something that one cannot describe but wants to experience over and over again.
              Like the meaning of Buttercup, the bakery is a culmination of years of traveling the world and experiencing people through their food, decades of culinary and restaurant experience, and the staunch belief that what you eat changes who you are.
            </p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="bg-post text-dark">  <!--bg-dark - white-->
      <div class="container text-justify">
        <h1 class="mb-4 text-center ultimos-titulo">Don't miss our latest post!</h1>
        <br>
          <div class="row">
                  <!--POST-->
                  <?php 
                  //Sacar los post
                  $args = array('posts_per_page' => 3); 
                  $custom_query = new WP_Query($args);
                  if ( $custom_query->have_posts() ): while ($custom_query->have_posts()): $custom_query->the_post(); 
                  ?>
                  <div class="col-lg-4">
                    <div class="service-block">
                        <div class="post-content">
                            <div class="content-foto" style="background-image: url('<?php 
                              if(has_post_thumbnail() ) {
                                $postImg = get_the_post_thumbnail_url();
                              } else{
                                $postImg = get_template_directory_uri()."/img/default.jpg";
                              }
                                echo $postImg;
                              ?>');">
                            </div>
                            <h4 class="post-titulo"><a href="<?php the_permalink(); ?>" class="title blue-letter text-uppercase text-left"><?php the_title(); ?></a></h4>
                            <div class="info text-left post-date">
                              <span class="fecha"> <?php the_date(); ?></span>
                            </div>
                            <!--Fin imagen del post -->
                            <!-- extracto del post-->
                            <div class="post-cuerpo">
                            <p><?php the_excerpt();?></p>
                            </div>
                            <div class="text-center">
                              <a class="btn btn-light blue-letter btn-xs sr-button text-center boton-read" href="<?php the_permalink(); ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                    </div>
                  <?php 
                    endwhile; endif;
                    wp_reset_query();
                  ?>
          </div>
      </div>
    </section>
    
    <!--PRODUCTS-->
    
    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/01.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/01.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Cake
                  </div>
                  <div class="project-name">
                    Happy Birthday
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/02.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/02.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Special
                  </div>
                  <div class="project-name">
                    San Valentin
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/03.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/03.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Donut
                  </div>
                  <div class="project-name">
                    Breakfast
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/04.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/04.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Holy Days
                  </div>
                  <div class="project-name">
                    Thanksgiving Day
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/05.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/05.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Fruit
                  </div>
                  <div class="project-name">
                    Strawberry
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="<?php echo bloginfo('template_directory'); ?>/img/gallery/img-full/06.jpg">
              <img class="img-gallery-thumbnail" src="<?php echo get_template_directory_uri(); ?>/img/gallery/img-full/06.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Journey
                  </div>
                  <div class="project-name">
                    Cupcake
                  </div>
                </div>
              </div>
            </a>
          </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
        </div>
      </div>
    </section>
<?php get_footer(); ?>
