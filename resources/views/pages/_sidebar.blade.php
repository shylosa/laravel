<div class="col-md-4" data-sticky_column>
  <div class="primary-sidebar">
    @include('admin.errors')
    @if($popularPosts ?? '')
      <aside class="widget">
        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
        @foreach($popularPosts ?? '' as $post)
          <div class="popular-post">
            <a href="{{ route('post.show', $post->slug) }}" class="popular-img">
              <img src="{{ $post->getMainPhoto() }}" alt="">
              <div class="p-overlay"></div>
            </a>
            <div class="p-content">
              <a href="{{ route('post.show', $post->slug) }}" class="text-uppercase">{{ $post->translate()->title }}</a>
              <span class="p-date">{{ $post->getDate() }}</span>
            </div>
          </div>
        @endforeach
      </aside>
    @endif
  </div>
</div>