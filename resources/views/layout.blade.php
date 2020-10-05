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
  <div class="navbar-wrapper">
    <input id="menu__toggle" type="checkbox"/>
    <label class="menu__btn" for="menu__toggle"><span></span></label>

    <div class="menu__box">
      <a class="navbar-brand page-scroll" href="{{ route('home') }}">
        <img src="/images/logo.png" alt="">{{ config('app.name') }}</a>
      @include('pages._language-menu')
      <ul class="menu__list" onclick="document.getElementById('menu__toggle').checked=false">
        <li><a class="menu__item" href="#about">{{ __('main.about') }}</a></li>
        <li><a class="menu__item" href="#services">{{ __('main.services') }}</a></li>
        <li><a class="menu__item" href="#portfolio">{{ __('main.portfolio') }}</a></li>
        <li><a class="menu__item" href="#contacts">{{ __('main.contacts') }}</a></li>
        @if (Auth::check() && Auth::user()->isAdmin())
          <li>
            <a class="menu__item" href="{{ route('admin') }}">{{ __('main.admin_page') }}</a>
          </li>
        @endif
        @if (Auth::check())
          <li>
            <a class="menu__item" href="{{ route('logout') }}">{{ __('main.logout') }}</a>
          </li>
        @endif
      </ul>
    </div>
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
<div class="js-scroll-to-top">@include('pages._scrollToTop')</div>
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