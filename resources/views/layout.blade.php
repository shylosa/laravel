<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon icon -->
  <title>{{config('app.name')}}</title>

  <!-- common css -->
  <link rel="stylesheet" href="/css/front.css">

  <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="assets/js/html5shiv.js"></script>
  <script src="assets/js/respond.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/favicon.png">
</head>

<body>

<nav class="main-header">
  <div class="nav navbar fixed-top navbar-expand-lg">
    <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="">JAYwood</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="">О нас</a></li>
        <li class="nav-item"><a class="nav-link" href="">Услуги</a></li>
        <li class="nav-item"><a class="nav-link" href="">Проекты</a></li>
        <li class="nav-item"><a class="nav-link" href="">Контакты</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.navbar-expand-->
</nav>
<!-- /.main-header-->

<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if(session('success'))
        <div class="alert alert-info">
          {{session('success')}}
        </div>
      @endif
    </div>
  </div>
</div>
@yield('content')

<!--footer start-->
<div id="footer">
  <div class="footer-instagram-section">
    <h3 class="footer-instagram-title text-center text-uppercase">Instagram</h3>

    <div id="footer-instagram" class="owl-carousel">

      <div class="item">
        <a href="#"><img src="/images/ins-1.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-2.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-3.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-4.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-5.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-6.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-7.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="/images/ins-8.jpg" alt=""></a>
      </div>

    </div>
  </div>
</div>

<footer class="footer-widget-section">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <aside class="footer-widget">
          <div class="about-img"><img src="/images/footer-logo.png" alt=""></div>
          <div class="about-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
            accusam et justo duo dlores et ea rebum magna text ar koto din.
          </div>
          <div class="address">
            <h4 class="text-uppercase">Контакты</h4>
            <p> г. Новомосковск</p>
            <p>Днепропетровская обл.</p>
            <p>iphoneapple335@gmail.com</p>
            <p>+38 067 636 9961</p>
          </div>
        </aside>
      </div>

      <div class="col-md-4">
        <aside class="footer-widget">
          <h3 class="widget-title text-uppercase">Testimonials</h3>

          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!--Indicator-->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <div class="single-review">
                  <div class="review-text">
                    <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                      tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                      vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                      magna aliquyam eratma</p>
                  </div>
                  <div class="author-id">
                    <img src="/images/author.png" alt="">

                    <div class="author-text">
                      <h4>Sophia</h4>

                      <h4>Client, Tech</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="single-review">
                  <div class="review-text">
                    <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                      tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                      vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                      magna aliquyam eratma</p>
                  </div>
                  <div class="author-id">
                    <img src="/images/author.png" alt="">

                    <div class="author-text">
                      <h4>Sophia</h4>

                      <h4>Client, Tech</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </aside>
      </div>
      <div class="col-md-4">
        <aside class="footer-widget">
          <h3 class="widget-title text-uppercase">Custom Category Post</h3>


          <div class="custom-post">
            <div>
              <a href="#"><img src="/images/footer-img.png" alt=""></a>
            </div>
            <div>
              <a href="#" class="text-uppercase">Home is peaceful Place</a>
              <span class="p-date">February 15, 2016</span>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <div class="footer-copy">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-center">&copy; 2019 <a href="#">{{config('app.name')}}, </a>
            Designed by <a href="#">shylosa</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- js files -->
<script src="/js/front.js"></script>
</body>
</html>