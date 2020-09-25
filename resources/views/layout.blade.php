<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- favicon icon -->
  <title>{{ config('app.name') }}</title>
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
  @include('pages._language-menu')
  <div class="nav navbar fixed-top navbar-expand-lg">
    <a class="navbar-brand page-scroll" href="{{ route('home') }}"><img src="/images/logo.png" alt="">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#jw-navbar"
            aria-controls="jw-navbar" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="jw-navbar">
      <ul class="nav navbar-nav ml-auto">
        <!-- .language -->
      <!-- ./language -->
        <li class="nav-item"><a class="nav-link page-scroll" href="#about">{{ __('main.about') }}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#services">{{ __('main.services') }}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#portfolio">{{ __('main.portfolio') }}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#gallery">{{ __('main.gallery') }}</a></li>
        <li class="nav-item"><a class="nav-link page-scroll" href="#contacts">{{ __('main.contacts') }}</a></li>
        @if (Auth::check() && Auth::user()->isAdmin())
          <li class="nav-item"><a class="nav-link page-scroll" href="{{ route('admin') }}">{{ __('main.admin_page') }}</a>
          </li>
        @endif
        @if (Auth::check())
          <li class="nav-item"><a class="nav-link page-scroll" href="{{ route('logout') }}">{{ __('main.logout') }}</a>
          </li>
        @endif
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.navbar-expand-->
  <div class="overlay">
    <div>
      <h1>{{ config('app.name') }}<span>/</span>Handcrafted Furniture Factory</h1>
    </div>
    <div>
      <p>{{ __('main.slogan') }}</p>
    </div>
    <a href="#about" class="btn btn-custom page-scroll">{{ __('main.more') }}</a>
  </div>
</nav>
<!-- /.main-header-->

@yield('content')

<!-- section-instagram start-->
<div class="section-instagram" id="gallery">
  <div class="container-fluid">
    <div class="section-title">
      <h3>{{ __('main.gallery') }}</h3>
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
        <h2>{{ __('main.how_contacts') }}</h2>
        <hr>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p>
      <div class="row">
        <div class="col-md-4">
          <aside class="contact-widget">
            <div class="about-img">
              <img src="/images/footer-logo.png" alt=""><span>{{ config('app.name') }}</span>
            </div>
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
          <h4 class="text-uppercase">{{ __('main.where') }}:</h4>
          <p>{{ __('main.Novomoskovsk') }}</p>
          <p>{{ __('main.Dnipropetrovsk_region') }}</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ./section-contacts -->

<!-- footer -->
<footer class="footer">
  <div class="container">
    <div class="text-center">&copy;2020<a href="#">{{ config('app.name') }}, </a>Designed by <a href="#">shylosa</a>
    </div>
  </div>
</footer>
<!-- ./footer -->
<!-- js files -->
<script src="/js/front.js"></script>
</body>
</html>