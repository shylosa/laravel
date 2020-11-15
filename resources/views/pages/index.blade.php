@extends('layouts.layout')

@section('overlay')
  <div class="overlay">
    <div>
      <h1>{{ config('app.name') }}<span>/</span>{{ __('Handcrafted Furniture Factory') }}</h1>
    </div>
    <div>
      <p>{{ __('main.slogan') }}</p>
    </div>
    <a id="js-more-button" href="#about" class="btn btn-custom">{{ __('main.more') }}</a>
  </div>
@endsection

@section('content')

  <!-- .section-about -->
  <section class="section-about js-anchor" id="about">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.history') }}</h2>
        <hr>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6 history-image"><img src="/images/about.jpg" alt=""></div>
        <div class="col-xs-12 col-md-6">
          <div class="about-text">
            <h3>{{ __('main.factory') }}</h3>
            <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
              commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.') }}</p>
            <h3>{{ __('main.what_we_make') }}</h3>
            <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
              commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.section-about -->

  <!-- .section-services -->
  <section class="section-services js-anchor" id="services">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.our_services') }}</h2>
        <hr>
      </div>
      <div class="row">
        <div class="col-xs-12 col-lg-4 services">
          <div class="services-image">
            <img src="/images/outside-design.jpg" class="img-responsive" alt="Project Title">
          </div>
          <h3>{{ __('main.playgrounds') }}</h3>
          <p>{{ __('Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.') }}</p>
        </div>
        <div class="col-xs-12 col-lg-4 services">
          <div class="services-image">
            <img src="/images/restoration-design.jpg" class="img-responsive" alt="Project Title">
          </div>
          <h3>{{ __('main.restoration') }}</h3>
          <p>{{ __('Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.') }}</p>
        </div>
        <div class="col-xs-12 col-lg-4 services">
          <div class="services-image">
            <img src="/images/stairs-design.jpg" class="img-responsive" alt="Project Title">
          </div>
          <h3>{{ __('main.stairs') }}</h3>
          <p>{{ __('Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.') }}</p>
        </div>
      </div>
    </div>
  </section>
  <!-- /.section-services -->

  <!-- .section-portfolio -->
  <section class="section-portfolio js-anchor" id="portfolio">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.completed_projects') }}</h2>
        <hr>
      </div>
      <!-- Slider -->
      <div class="swiper-container swiper-container__main">
        <div class="swiper-wrapper" id="slider__main">
          <!-- Slides -->
          @foreach($projects as $project)
            <div class="swiper-slide swiper-slide__main" style="background-image: url({{ $project->getMainPhoto() }})">
              <div class="hover-bg">
                <a href="{{ route('projects.show_project', $project->getSlug()) }}" title="{{ $project->getTitle() }}">
                  <div class="hover-text">
                    <h4>{{ $project->getTitle() }}</h4>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
          <!-- /Slides -->
        </div>
        <div class="swiper-pagination swiper-pagination__main"></div>
        <div class="swiper-button-prev swiper-button-prev__main"></div>
        <div class="swiper-button-next swiper-button-next__main"></div>
        <div class="swiper-scrollbar swiper-scrollbar__main"></div>
      </div>
      <!-- /Slider -->
      <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.') }}</p>
    </div>
  </section>
  <!-- ./section-portfolio -->
@endsection