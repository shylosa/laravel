@extends('layouts.layout')

@section('content')
  <!--main content start-->
  <section class="section-show-page">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <article class="post">
            <div class="post-content">
              <header class="entry-header text-center text-uppercase">
                <h1 class="entry-title">{{ $project->getTitle() }}</h1>
              </header>
              @foreach($project->photos as $photo)
                <div class="project-photo">
                  <img src="{{ $photo->getPhoto() }}" alt="">
                </div>
                @if (!$loop->last)
                  <hr>
                @endif
              @endforeach

              @if($project->hasCategory())
                <h2 class="text-center">
                  <a href="{{ route('categories.show', $project->category->getSlug()) }}">{{ $project->getCategoryTitle() }}</a>
                </h2>
              @endif
              @if ($project->hasTags())
                <div class="decoration">
                  <span>{{ __('main.tags') }}:</span>
                  @foreach($project->tags as $tag)
                    <a href="{{ route('tags.show', $tag->getSlug()) }}" class="btn btn-default">{{ $tag->getTitle() }}</a>
                  @endforeach
                </div>
              @endif
            </div>
          </article>
        </div>
      </div>
      <div class="related-heading">
        <h4>{{ __('You might also like') }}</h4>
      </div>
      <div class="related-post-carousel"><!--related post carousel-->
        <!-- Slider -->
        <div class="swiper-container swiper-container__page-show">
          <div class="swiper-wrapper" id="slider__page-show">
            <!-- Slides -->
            @foreach($project->related() as $item)
              <div class="swiper-slide swiper-slide__page-show" style="background-image: url({{ $item->getMainPhoto() }})">
                <div class="hover-bg">
                  <a href="{{ route('projects.show_project', $item->getSlug()) }}" title="{{ $item->getTitle() }}">
                    <div class="hover-text">
                      <h4>{{ $item->getTitle() }}</h4>
                    </div>
                  </a>
                </div>
              </div>
          @endforeach
          <!-- /Slides -->
          </div>
          <div class="swiper-pagination swiper-pagination__page-show"></div>
          <div class="swiper-button-prev swiper-button-prev__page-show"></div>
          <div class="swiper-button-next swiper-button-next__page-show"></div>
          <div class="swiper-scrollbar swiper-scrollbar__page-show"></div>
        </div>
        <!-- /Slider -->
      </div><!--related post carousel-->
    </div>
  </section>
  <!-- end main content-->
@endsection