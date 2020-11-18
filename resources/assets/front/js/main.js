function main() {
  // eslint-disable-next-line func-names
  Element.prototype.show = function () {
    if (!this.classList.contains('show')) {
      this.classList.remove('hide');
      this.classList.add('show');
    }
  };
  // eslint-disable-next-line func-names
  Element.prototype.hide = function () {
    if (!this.classList.contains('hide')) {
      this.classList.remove('show');
      this.classList.add('hide');
    }
  };
  // eslint-disable-next-line func-names
  Element.prototype.addClass = function (cls) {
    if (!this.classList.contains(cls)) {
      this.classList.add(cls);
    }
  };
  // eslint-disable-next-line func-names
  Element.prototype.removeClass = function (cls) {
    if (this.classList.contains(cls)) {
      this.classList.remove(cls);
    }
  };
  // eslint-disable-next-line func-names
  Element.prototype.toggleClass = function (cls) {
    if (!this.classList.contains(cls)) {
      this.classList.add(cls);
    } else {
      this.classList.remove(cls);
    }
  };

  function isHasAnchorsOnCurrentPage() { // 1 - because footer has 'contacts' anchor
    return document.querySelectorAll('.js-anchor').length > 1;
  }

  function isAnchor(href) {
    return href.indexOf('#') !== -1;
  }

  function isMenuOpen() {
    return document.getElementById('menu__toggle').classList.contains('js-checked');
  }

  function toggleMenu() {
    document.getElementById('menu__toggle').toggleClass('js-checked');
  }

  function toggleScrollbar() {
    const { marginRight } = document.body.style;
    // Default value 5px for goTop button
    const defaultMarginRightGoTop = 5;
    const goTop = document.getElementById('js-scroll-to-top');

    if (marginRight === '0px' || marginRight === '') {
      const scrollbarWidth = window.innerWidth - document.body.clientWidth;
      document.body.style.marginRight = `${scrollbarWidth}px`;
      // Prevent move goTopButton
      goTop.style.marginRight = `${scrollbarWidth + defaultMarginRightGoTop}px`;
    } else {
      document.body.style.marginRight = '0px';
      goTop.style.marginRight = `${defaultMarginRightGoTop}px`;
    }
  }

  function toggleLockScroll() {
    document.body.toggleClass('js-disable-scroll');
  }

  const scrollToTopLink = document.getElementById('js-scroll-to-top');
  scrollToTopLink.addEventListener('click', () => {
    window.scroll({
      top: 0,
      behavior: 'smooth',
    });
  });

  function toggleHandler() {
    toggleMenu();
    toggleScrollbar();
    toggleLockScroll();
    scrollToTopLink.hide();
  }

  function getLocale() {
    const defaultLocale = 'ru';
    const locale = document.getElementsByTagName('html')[0].getAttribute('lang');
    if (typeof locale === 'string' && locale !== defaultLocale) {
      return locale;
    }

    return '';
  }

  function menuItemsHandler(e) {
    e.preventDefault();
    const href = this.getAttribute('href');

    if (isHasAnchorsOnCurrentPage() && isAnchor(href)) {
      const { offsetTop } = document.querySelector(href);
      // eslint-disable-next-line no-restricted-globals
      scroll({
        top: offsetTop,
        behavior: 'smooth',
      });
      if (e.target.getAttribute('id') === 'js-more-button') {
        return;
      }
      // Close menu bar
      if (isMenuOpen()) {
        toggleHandler();
      }
    } else if (!isAnchor(href)) {
      window.location.href = href;
    } else {
      window.location.href = `${window.location.origin}/${getLocale()}${href}`;
    }
  }

  // Scroll page to selected menu item
  const links = document.querySelectorAll('.menu__item');
  // eslint-disable-next-line no-restricted-syntax
  for (const link of links) {
    link.addEventListener('click', menuItemsHandler);
  }

  const jsMoreButton = document.getElementById('js-more-button');
  if (typeof jsMoreButton !== 'undefined' && jsMoreButton) {
    jsMoreButton.addEventListener('click', menuItemsHandler);
  }

  function showScrollToTopLink() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      scrollToTopLink.show();
    } else {
      scrollToTopLink.hide();
    }
  }

  window.addEventListener('scroll', showScrollToTopLink);

  // Open menu and lock page scroll
  document.getElementById('menu__toggle').addEventListener('click', toggleHandler);
}

window.addEventListener('load', () => {
  const preloader = document.querySelector('.preloader');
  if (typeof preloader !== 'undefined' && preloader) {
    preloader.hide();
    setTimeout(() => {
      preloader.style.display = 'none';
    }, 600);
  }
});

main();
