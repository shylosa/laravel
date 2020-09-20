@extends('layout')

@section('content')


  <!-- .section-about -->
  <section class="section-about" id="about">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.history') }}</h2>
        <hr>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6"><img src="/images/about.jpg" alt=""></div>
        <div class="col-xs-12 col-md-6">
          <div class="about-text">
            <h3>{{ __('main.factory') }}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
              commodo
              nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.</p>
            <h3>{{ __('main.what_we_make') }}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
              commodo
              nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.section-about -->

  <!-- .section-services -->
  <section class="section-services" id="services">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.our_services') }}</h2>
        <hr>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-4 service"><img src="/images/outside-design.jpg" class="img-responsive"
                                                     alt="Project Title">
          <h3>{{ __('main.playgrounds') }}</h3>
          <p>Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.</p>
        </div>
        <div class="col-xs-12 col-sm-4 service"><img src="/images/restoration-design.jpg" class="img-responsive"
                                                     alt="Project Title">
          <h3>{{ __('main.restoration') }}</h3>
          <p>Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.</p>
        </div>
        <div class="col-xs-12 col-sm-4 service"><img src="/images/stairs-design.jpg" class="img-responsive"
                                                     alt="Project Title">
          <h3>{{ __('main.stairs') }}</h3>
          <p>Lorem ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend pellentesque natoque etiam. Lorem
            ipsum dolor sit amet placerat facilisis felis mi in tempus eleifend.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- /.section-services -->

  <!-- .section-portfolio -->
  <section class="section-portfolio" id="portfolio">
    <div class="container">
      <div class="section-title">
        <h2>{{ __('main.completed_projects') }}</h2>
        <hr>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p>
      <div class="categories">
        <ul class="cat">
          <li>
            <ol class="type">
              <li><a href="#" data-filter="*" class="active">{{ __('All Projects') }}</a></li>
              <li><a href="#" data-filter=".residential">{{ __('Residential') }}</a></li>
              <li><a href="#" data-filter=".office">{{ __('Office') }}</a></li>
              <li><a href="#" data-filter=".commercial">{{ __('Commercial') }}</a></li>
            </ol>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="row portfolio-items">
        @foreach($projects as $project)
          <div class="col-sm-6 col-md-4 col-lg-4 portfolio-item residential">
            <div class="hover-bg">
              <a href="{{ route('project.show', $project->translate()->slug) }}" title="{{ $project->translate()->title }}"
                 data-lightbox-gallery="gallery1">
                <div class="hover-text">
                  <h4>{{ $project->translate()->title }}</h4>
                </div>
                <img src="{{ $project->getMainPhoto() }}" alt="{{ $project->translate()->title }}">
              </a>

            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- ./section-portfolio -->

@endsection