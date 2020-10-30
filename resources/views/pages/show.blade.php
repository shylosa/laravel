@extends('layouts.layout')

@section('content')
  <!--main content start-->
  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <article class="post">
            <div class="post-content">
              <header class="entry-header text-center text-uppercase">
                <h1 class="entry-title">{{ $project->getTitle() }}</h1>
              </header>
              <img src="{{ $project->getMainPhoto() }}" alt="">
              @if($project->hasCategory())
                <h6>
                  <a href="{{ route('categories.show', $project->category->getSlug()) }}">{{ $project->getCategoryTitle() }}</a>
                </h6>
              @endif
              <div class="decoration">
                @foreach($project->tags as $tag)
                  <a href="{{ route('tags.show', $tag->getSlug()) }}" class="btn btn-default">{{ $tag->getTitle() }}</a>
                @endforeach
              </div>
            </div>
          </article>
          <div class="row"><!--project next previous-->
            <div class="col-md-6">
              @if($project->hasPrevious())
                <div class="single-blog-box">
                  <a href="{{ route('projects.show_project', $project->getPrevious()->getSlug()) }}">
                    <img src="{{ $project->getPrevious()->getMainPhoto() }}" alt="">
                    <div class="overlay">
                      <div class="promo-text">
                        <p><i class=" pull-left fas fa-angle-left"></i></p>
                        <h5>{{ $project->getPrevious()->getTitle() }}</h5>
                      </div>
                    </div>
                  </a>
                </div>
              @endif
            </div>
            <div class="col-md-6">
              @if($project->hasNext())
                <div class="single-blog-box">
                  <a href="{{ route('projects.show_project', $project->getNext()->getSlug()) }}">
                    <img src="{{ $project->getNext()->getMainPhoto() }}" alt="">
                    <div class="overlay">
                      <div class="promo-text">
                        <p><i class=" pull-right fas fa-angle-right"></i></p>
                        <h5>{{ $project->getNext()->getTitle() }}</h5>
                      </div>
                    </div>
                  </a>
                </div>
              @endif
            </div>
          </div><!--/project next previous-->
          <div class="related-post-carousel"><!--related post carousel-->
            <div class="related-heading">
              <h4>{{ __('You might also like') }}</h4>
            </div>
            <!-- Slider -->
            <div class="swiper-container-show">
              <div class="swiper-wrapper" id="show-slider">
                <!-- Slides -->
                @foreach($project->related() as $item)
                  <div class="swiper-slide">
                    <div class="hover-bg">
                      <a href="{{ route('projects.show_project', $item->getSlug()) }}" title="{{ $item->getTitle() }}">
                        <div class="hover-text">
                          <h4>{{ $item->getTitle() }}</h4>
                        </div>
                        <img src="{{ $item->getMainPhoto() }}" alt="{{ $item->getTitle() }}">
                      </a>
                    </div>
                  </div>
              @endforeach
              <!-- /Slides -->
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
              <div class="swiper-scrollbar"></div>
            </div>
            <!-- /Slider -->
          </div><!--related post carousel-->
        </div>
        @include('pages._sidebar')
      </div>
    </div>
  </div>
  <!-- end main content-->
@endsection