@extends('layouts.layout')

@section('content')
  <!--main content start-->
  <section class="section-list-page">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            @forelse($projects as $project)
              <div class="col-md-6">
                <article class="post post-grid">
                  <div class="post-thumb">
                    <a href="{{ route('projects.show_project', $project->getSlug()) }}">
                      <img src="{{ $project->getMainPhoto() }}" alt="">
                    </a>
                  </div>
                  <div class="post-content">
                    <header class="entry-header text-center text-uppercase">
                      @if($project->hasCategory())
                        <h6>
                          <a href="{{ route('categories.show_category', $project->category->getSlug()) }}"> {{$project->getCategoryTitle()}}</a>
                        </h6>
                      @endif
                      <h1 class="entry-title">
                        <a href="{{ route('projects.show_project', $project->getSlug()) }}">{{ $project->getTitle() }}</a>
                      </h1>
                    </header>
                    <div class="entry-content">
                      {{ $project->description }}
                      <div class="social-share"></div>
                    </div>
                  </div>
                </article>
              </div>
            @empty
              <p>{{ __('No projects') }}</p>
            @endforelse
          </div>
          {{ $projects->links() }}
        </div>
      </div>
    </div>
  </section>
  <!-- end main content-->
@endsection