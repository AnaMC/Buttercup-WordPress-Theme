<?php wp_footer(); ?>
  <footer class="bg-primary blue-back footer-bakery text-color-01" id="about">
      <div class="container">
        <div class="row footer-row">
          <div class="col-lg-3 text-center">
           <h1 class ="logo-footer text-white">Buttercup</h1>
           <p class = "text-justify">Amamos los detalles, por eso, en pleno corazon de Granada y con los ingredientes más exquisitos, 
                                     llevamos a cabo nuestros productos, que de forma artesanal mezclamos y horneamos con gran pasión para que cada bocado sea inolvidable.</p>
            <div class="">
                <a class="" href="www.facebook.com"><i class="fab fa-facebook-square fa-2x" style="padding-left:10px;"></i></a>
                <a class="" href="www.instagram.com"><i class="fab fa-2x fa-instagram" style="padding-left:10px;"></i></a>
                <a class="" href="www.twitter.com"><i class="fab fa-2x fa-twitter" style="padding-left:10px;"></i></a>
                <a class="" href="www.tripadvisor.com"><i class="fab fa-2x fa-tripadvisor" style="padding-left:10px;"></i></a>
            </div>   
          </div>
          <div class="col-lg-3 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12"><h4 class="text-uppercase text-white"> Links </h4></div>
                        <li class="li-f"><a class="text-color-01" href="<?= get_option('Home') ?>">Home</a></li>
                        <li class="li-f"><a class="text-color-01" href="<?= get_option('blog') ?>">blog</a></li>
                        <li class="li-f"><a class="text-color-01" href="<?= get_option('products') ?>">products</a></li>
                        <li class="li-f"><a class="text-color-01" href="<?= get_option('contact') ?>">contact</a></li>
                    </div>
                </div>
          </div>
          <div class="col-lg-3 text-center">
            <h4 class="text-left text-uppercase text-white">Contacta con nosotros</h4>
            <p class="text-left"><i class="fas fa-envelope"></i>
             bcapbakery@gmail.com</p>
            <p class="text-left"><i class="fas fa-map"></i>
            Calle San Juan de los Reyes</p>
            <p class="text-left"><i class="fas fa-phone"></i>
            +34 958 36 98 72</p>
          </div>
          <div class="col-lg-3">
           <h4 class="text-uppercase text-white">Suscribete</h4>
           <div class="input-group">
                <div class="pb-3">
                    <input type="text" class="form-control" placeholder="Email Address">
                </div>
                
                <button class="btn" type="button">Subscribe</button>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
