<ul class="header-topline">
  @foreach (config('translatable.locales') as $lang => $language)
    @if ($lang === app()->getLocale())
      <li class="language-item__current">
        <span class="language-item">{{ $language }}</span>
      </li>
    @else
      <li class="language-item__noncurrent"><a href="{{ route('lang.switch', $lang) }}">{{ $language }}</a></li>
    @endif
  @endforeach
</ul>