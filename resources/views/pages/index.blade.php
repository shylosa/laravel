@extends('layout')

@section('content')
  <!--main content start-->
  <div class="main-content">
    <div class="container">
      <div class="row">

          @foreach($projects as $project)
          <div class="col-md-6">
            <article class="post">
              <div class="post-thumb">
                <a href="{{route('project.show', $project->slug)}}"><img src="{{$project->getImage()}}" alt=""></a>

                <a href="{{route('project.show', $project->slug)}}" class="post-thumb-overlay text-center">
                  <div class="text-uppercase text-center">View Post</div>
                </a>
              </div>
              <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                  @if($project->hasCategory())
                    <h6><a href="{{route('category.show', $project->category->slug)}}"> {{$project->getCategoryTitle()}}</a></h6>
                  @endif
                  <h1 class="entry-title"><a href="{{route('project.show', $project->slug)}}">{{$project->title}}</a></h1>

                </header>
                <div class="entry-content">
                  {!!$project->description!!}

                  <div class="btn-continue-reading text-center text-uppercase">
                    <a href="{{route('project.show', $project->slug)}}" class="more-link">Подробнее</a>
                  </div>
                </div>
                <div class="social-share">
                  <ul class="text-center pull-right">
                    <li><a class="s-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a class="s-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="s-instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                  </ul>
                </div>
              </div>
            </article>
        </div>
          @endforeach

          {{$projects->links()}}


      </div>
    </div>
  </div>
  <!-- end main content-->
@endsection