<ul class="header-topline__language">
  @foreach (config('translatable.locales') as $lang => $language)
    @if ($lang !== app()->getLocale())
      <li><a href="{{ route('lang.switch', $lang) }}">{{ $language }}</a></li>
    @else
      <li class="header-topline__language-item">
        <span class="header-topline__language-item_state_active">{{ $language }}</span>
      </li>
    @endif
  @endforeach
</ul>