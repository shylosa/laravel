@extends('layout')

@section('content')
  <!--main content start-->
  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <article class="post">
            <div class="post-thumb">
              <a href="{{ route('projects.show_all', $project->getSlug()) }}">
                <img src="{{ $project->getMainPhoto() }}" alt="">
              </a>
            </div>
            <div class="post-content">
              <header class="entry-header text-center text-uppercase">
                @if($project->hasCategory())
                  <h6>
                    <a href="{{ route('categories.show', $project->category->getSlug()) }}">{{ $project->getCategoryTitle() }}</a>
                  </h6>
                @endif
                <h1 class="entry-title">
                  <a href="{{ route('projects.show_all', $project->getSlug()) }}">{{ $project->getTitle() }}</a>
                </h1>
              </header>
              <div class="decoration">
                @foreach($project->tags as $tag)
                  <a href="{{ route('tags.show', $tag->getSlug()) }}" class="btn btn-default">{{ $tag->getTitle() }}</a>
                @endforeach
              </div>
              <div class="social-share">
                <ul class="text-center pull-right">
                  <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
            </div>
          </article>
          <div class="top-comment"><!--top comment-->
            <img src="/images/comment.jpg" class="pull-left img-circle" alt="">
            <h4>Rubel Miah</h4>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
              invidunt ut labore et dolore magna aliquyam erat.</p>
          </div><!--top comment end-->
          <div class="row"><!--blog next previous-->
            <div class="col-md-6">
              @if($project->hasPrevious())
                <div class="single-blog-box">
                  <a href="{{ route('projects.show_all', $project->getPrevious()->getSlug()) }}">
                    <img src="{{ $project->getPrevious()->getMainPhoto() }}" alt="">
                    <div class="overlay">
                      <div class="promo-text">
                        <p><i class=" pull-left fa fa-angle-left"></i></p>
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
                  <a href="{{ route('projects.show_all', $project->getNext()->getSlug()) }}">
                    <img src="{{ $project->getNext()->getMainPhoto() }}" alt="">
                    <div class="overlay">
                      <div class="promo-text">
                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                        <h5>{{ $project->getNext()->getTitle() }}</h5>
                      </div>
                    </div>
                  </a>
                </div>
              @endif
            </div>
          </div><!--blog next previous end-->
          <div class="related-post-carousel"><!--related post carousel-->
            <div class="related-heading">
              <h4>You might also like</h4>
            </div>
            <div class="items">
              @foreach($project->related() as $item)
                <div class="single-item">
                  <a href="{{ route('projects.show_all', $item->getSlug()) }}">
                    <img src="{{ $item->getMainPhoto() }}" alt="">
                    <p>{{ $item->getTitle() }}</p>
                  </a>
                </div>
              @endforeach
            </div>
          </div><!--related post carousel-->
        </div>
        @include('pages._sidebar')
      </div>
    </div>
  </div>
  <!-- end main content-->
@endsection