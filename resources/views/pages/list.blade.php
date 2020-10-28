@extends('layouts.layout')

@section('content')
  <!--main content start-->
  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            @foreach($projects as $project)
              <div class="col-md-6">
                <article class="post post-grid">
                  <div class="post-thumb">
                    <a href="{{ route('project.show', $project->slug) }}">
                      <img src="{{ $project->getImage() }}" alt="">
                    </a>
                    <a href="{{ route('project.show', $project->slug) }}" class="post-thumb-overlay text-center">
                      <div class="text-uppercase text-center">View Post</div>
                    </a>
                  </div>
                  <div class="post-content">
                    <header class="entry-header text-center text-uppercase">
                      @if($project->hasCategory())
                        <h6>
                          <a href="{{ route('category.show', $project->category->slug) }}"> {{$project->getCategoryTitle()}}</a>
                        </h6>
                      @endif
                      <h1 class="entry-title">
                        <a href="{{ route('project.show', $project->slug) }}">{{ $project->title }}</a>
                      </h1>
                    </header>
                    <div class="entry-content">
                      {{ $project->description }}
                      <div class="social-share"></div>
                    </div>
                  </div>
                </article>
              </div>
            @endforeach
          </div>
          {{ $projects->links() }}
        </div>
        @include('pages._sidebar')
      </div>
    </div>
  </div>
  <!-- end main content-->
@endsection