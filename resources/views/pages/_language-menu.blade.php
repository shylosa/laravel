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
<style>
    .header-topline {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%);
        padding-left: 0;
    }

    .language-item__current,
    .language-item__noncurrent,
    .header-topline .language-item__noncurrent a {
        font-size: 14px;
        font-weight: 700;
        font-family: 'Arsenal', sans-serif;
        text-transform: uppercase;
        text-decoration: none;
    }
    .language-item__current {
        color: #ff0000;
    }

    .language-item__noncurrent {
        color: #5f3f3f;
    }

    .header-topline li {
        display: inline-block;
        margin-right: 5px;
    }

    .header-topline li:last-child {
        margin-right: 0;
    }
</style>