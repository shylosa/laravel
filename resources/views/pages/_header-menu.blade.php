<ul class="menu__list">
  <li><a class="menu__item" href="#about">{{ __('main.about') }}</a></li>
  <li><a class="menu__item" href="#services">{{ __('main.services') }}</a></li>
  <li><a class="menu__item" href="#portfolio">{{ __('main.portfolio') }}</a></li>
  <li><a class="menu__item" href="#contacts">{{ __('main.contacts') }}</a></li>
  @auth
    @if (Auth::user()->isAdmin())
      <li><a class="menu__item" href="{{ route('admin') }}">{{ __('main.admin_page') }}</a></li>
    @endif
      <li><a class="menu__item" href="{{ route('logout') }}">{{ __('main.logout') }}</a></li>
  @endauth
</ul>
