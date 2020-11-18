// eslint-disable-next-line require-jsdoc
function main() {
  // Scroll page to selected menu item
  const links = document.querySelectorAll('.menu__item');
  for (const link of links) {
    link.addEventListener('click', menuItemsHandler);
  }

  const jsMoreButton = document.getElementById('js-more-button');
  if (typeof jsMoreButton !== 'undefined' && jsMoreButton) {
    jsMoreButton.addEventListener('click', menuItemsHandler);
  }

  // eslint-disable-next-line require-jsdoc
  function menuItemsHandler(e) {
    e.preventDefault();
    const href = this.getAttribute('href');

    if (isHasAnchorsOnCurrentPage() && isAnchor(href)) {
      const offsetTop = document.querySelector(href).offsetTop;
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
      window.location.href = window.location.origin + '/' + getLocale() + href;
    }
  }

  // eslint-disable-next-line require-jsdoc,max-len
  function isHasAnchorsOnCurrentPage() { // 1 - because footer has 'contacts' anchor
    return document.querySelectorAll('.js-anchor').length > 1;
  }

  // eslint-disable-next-line require-jsdoc
  function isAnchor(href) {
    return href.indexOf('#') !== -1;
  }

  // eslint-disable-next-line require-jsdoc
  function getLocale() {
    const defaultLocale = 'ru';
    // eslint-disable-next-line max-len
    const locale = document.getElementsByTagName('html')[0].getAttribute('lang');
    if (typeof locale === 'string' && locale !== defaultLocale) {
      return locale;
    }

    return '';
  }

  // Scroll to top link
  const scrollToTopLink = document.getElementById('js-scroll-to-top');
  scrollToTopLink.addEventListener('click', function() {
    window.scroll({
      top: 0,
      behavior: 'smooth',
    });
  });

  Element.prototype.show = function() {
    if (!this.classList.contains('show')) {
      this.classList.remove('hide');
      this.classList.add('show');
    }
  };
  Element.prototype.hide = function() {
    if (!this.classList.contains('hide')) {
      this.classList.remove('show');
      this.classList.add('hide');
    }
  };
  Element.prototype.addClass = function(cls) {
    if (!this.classList.contains(cls)) {
      this.classList.add(cls);
    }
  };
  Element.prototype.removeClass = function(cls) {
    if (this.classList.contains(cls)) {
      this.classList.remove(cls);
    }
  };
  Element.prototype.toggleClass = function(cls) {
    if (!this.classList.contains(cls)) {
      this.classList.add(cls);
    } else {
      this.classList.remove(cls);
    }
  };
  window.addEventListener('scroll', showScrollToTopLink);

  // eslint-disable-next-line require-jsdoc
  function showScrollToTopLink() {
    // eslint-disable-next-line max-len
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      scrollToTopLink.show();
    } else {
      scrollToTopLink.hide();
    }
  }

  // Open menu and lock page scroll
  // eslint-disable-next-line max-len
  document.getElementById('menu__toggle').addEventListener('click', toggleHandler);

  // eslint-disable-next-line require-jsdoc
  function toggleHandler() {
    toggleMenu();
    toggleScrollbar();
    toggleLockScroll();
    scrollToTopLink.hide();
  }

  // eslint-disable-next-line require-jsdoc
  function toggleLockScroll() {
    document.body.toggleClass('js-disable-scroll');
  }

  // eslint-disable-next-line require-jsdoc
  function toggleMenu() {
    document.getElementById('menu__toggle').toggleClass('js-checked');
  }

  // eslint-disable-next-line require-jsdoc
  function isMenuOpen() {
    // eslint-disable-next-line max-len
    return document.getElementById('menu__toggle').classList.contains('js-checked');
  }

  // eslint-disable-next-line require-jsdoc
  function toggleScrollbar() {
    const marginRight = document.body.style.marginRight;
    // Default value 5px for goTop button
    const defaultMarginRightGoTop = 5;
    const goTop = document.getElementById('js-scroll-to-top');

    if (marginRight === '0px' || marginRight === '') {
      const scrollbarWidth = window.innerWidth - document.body.clientWidth;
      document.body.style.marginRight = scrollbarWidth + 'px';
      // Prevent move goTopButton
      goTop.style.marginRight = scrollbarWidth + defaultMarginRightGoTop + 'px';
    } else {
      document.body.style.marginRight = '0px';
      goTop.style.marginRight = defaultMarginRightGoTop + 'px';
    }
  }
}

window.addEventListener('load', function() {
  const preloader = document.querySelector('.preloader');
  if (typeof preloader !== 'undefined' && preloader) {
    preloader.hide();
    setTimeout(() => {
      preloader.style.display = 'none';
    }, 600);
  }
});

main();
