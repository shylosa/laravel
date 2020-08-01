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
    <a class="navbar-brand page-scroll" href="/"><img src="/images/logo.png" alt="">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link page-scroll" href="#about">{{__('О нас')}}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#services">{{__('Услуги')}}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#portfolio">{{__('Проекты')}}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#gallery">{{__('Галерея')}}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#contacts">{{__('Контакты')}}</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.navbar-expand-->
  <div class="overlay">
    <div>
      <h1>{{config('app.name')}}<span>/</span>Handcrafted Furniture Factory</h1>
    </div>
    <div>
      <p>{{__('Индивидуальный подход к созданию мебели')}}</p>
    </div>
    <a href="#about" class="btn btn-custom page-scroll">{{__('Узнать больше')}}</a>
  </div>
</nav>
<!-- /.main-header-->

<!-- .language -->
<div class="language">
  <div class="soc">
    <button class="lang_button active">UA</button>
  </div>
  <div class="soc">
    <a href="/ru">
      <button class="lang_button noactive">RU</button>
    </a>
  </div>
  <div class="soc">
    <a href="/en">
      <button class="lang_button noactive">EN</button>
    </a>
  </div>
</div>
<!-- ./language -->

@yield('content')

<!-- section-instagram start-->
<div class="section-instagram" id="gallery">
  <div class="container-fluid">
    <div class="section-title">
      <h3>{{__('Галерея')}}</h3>
    </div>
    <div class="row">
      <div class="col">
        <a href="#"><img src="/images/ins-1.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-2.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-3.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-4.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-5.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-6.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-7.jpg" alt=""></a>
      </div>
      <div class="col">
        <a href="#"><img src="/images/ins-8.jpg" alt=""></a>
      </div>
    </div>
  </div>
</div>
<!-- ./section-instagram -->

<!-- section-contacts -->
<section class="section-contacts" id="contacts">
  <div class="container">
    <div class="container">
      <div class="section-title">
        <h2>{{__('Как с нами связаться')}}</h2>
        <hr>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p>
      <div class="row">
        <div class="col-md-4">
          <aside class="contact-widget">
            <div class="about-img"><img src="/images/footer-logo.png" alt=""><span>JOIwood</span></div>
            <div class="about-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
              eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
              accusam et justo duo dlores et ea rebum magna text ar koto din.
            </div>
            <div class="social-share">
              <ul>
                <li><a class="s-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a class="s-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a class="s-instagram" href="#"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </aside>
        </div>
        <div class="col-md-4 address">
            <h4 class="text-uppercase">Где мы находимся:</h4>
            <p> г. Новомосковск</p>
            <p>Днепропетровская обл.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ./section-contacts -->

<!-- footer -->
<footer class="footer">
  <div class="container">
    <div class="text-center">&copy; 2020 <a href="#">{{config('app.name')}}, </a>
      Designed by <a href="#">shylosa</a>
    </div>
  </div>
</footer>
<!-- ./footer -->



<!-- js files -->
<script src="/js/front.js"></script>
</body>
</html>