    <nav class="navbar navbar-expand-lg navbar-light fixed-top nav-principal white-back" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger font-allura logo-principal blue-letter" href="#page-top">ButterCup</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger blue-letter" href="<?= get_option('Home') ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger blue-letter" href="<?= get_page_link(get_page_by_title('blog')->ID) ?>">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger blue-letter" href="<?= get_page_link(get_page_by_title('products')->ID) ?>">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger blue-letter" href="<?= get_page_link(get_page_by_title('contact')->ID) ?>">Contact</a>
            </li>
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link js-scroll-trigger blue-letter" href="<?= get_page_link(get_page_by_title('prueba')->ID) ?>">prueba</a>-->
            <!--</li>-->
          </ul>
        </div>
      </div>
    </nav>