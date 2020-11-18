function main() {

    //Scroll page to selected menu item
    const links = document.querySelectorAll('.menu__item');
    for (const link of links) {
        link.addEventListener('click', menuItemsHandler);
    }

    let jsMoreButton = document.getElementById('js-more-button');
    if (typeof jsMoreButton !== 'undefined' && jsMoreButton) {
        jsMoreButton.addEventListener('click', menuItemsHandler);
    }

    function menuItemsHandler(e) {
        e.preventDefault();
        const href = this.getAttribute('href');

        if (isHasAnchorsOnCurrentPage() && isAnchor(href)) {
            const offsetTop = document.querySelector(href).offsetTop;
            scroll({
                top: offsetTop,
                behavior: 'smooth'
            });
            if (e.target.getAttribute('id') === 'js-more-button') {
                return;
            }
            //Close menu bar
            if (isMenuOpen()) {
                toggleHandler();
            }
        } else if (!isAnchor(href)) {
            window.location.href = href;
        } else {
            window.location.href = window.location.origin + '/' + getLocale() + href;
        }
    }

    function isHasAnchorsOnCurrentPage() {   // 1 - because footer has 'contacts' anchor
        return document.querySelectorAll('.js-anchor').length > 1;
    }

    function isAnchor(href) {
        return href.indexOf('#') !== -1;
    }

    function getLocale() {
        let defaultLocale = 'ru';
        let locale = document.getElementsByTagName('html')[0].getAttribute('lang');
        if (typeof locale === 'string' && locale !== defaultLocale) {
            return locale;
        }

        return '';
    }

    //Scroll to top link
    const scrollToTopLink = document.getElementById('js-scroll-to-top');
    scrollToTopLink.addEventListener('click', function () {
        window.scroll({
            top: 0,
            behavior: 'smooth'
        });
    });

    Element.prototype.show = function () {
        if (!this.classList.contains('show')) {
            this.classList.remove('hide');
            this.classList.add('show');
        }
    }
    Element.prototype.hide = function () {
        if (!this.classList.contains('hide')) {
            this.classList.remove('show');
            this.classList.add('hide');
        }
    }
    Element.prototype.addClass = function (cls) {
        if (!this.classList.contains(cls)) {
            this.classList.add(cls);
        }
    }
    Element.prototype.removeClass = function (cls) {
        if (this.classList.contains(cls)) {
            this.classList.remove(cls);
        }
    }
    Element.prototype.toggleClass = function (cls) {
        if (!this.classList.contains(cls)) {
            this.classList.add(cls);
        } else {
            this.classList.remove(cls);
        }
    }
    window.addEventListener('scroll', showScrollToTopLink);

    function showScrollToTopLink() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            scrollToTopLink.show();
        } else {
            scrollToTopLink.hide();
        }
    }

    //Open menu and lock page scroll
    document.getElementById('menu__toggle').addEventListener('click', toggleHandler);

    function toggleHandler() {
        toggleMenu();
        toggleScrollbar();
        toggleLockScroll();
        scrollToTopLink.hide();
    }

    function toggleLockScroll() {
        document.body.toggleClass('js-disable-scroll');
    }

    function toggleMenu()
    {
        document.getElementById('menu__toggle').toggleClass('js-checked');
    }

    function isMenuOpen()
    {
        return document.getElementById('menu__toggle').classList.contains('js-checked');
    }

    function toggleScrollbar()
    {
        let marginRight = document.body.style.marginRight;
        //Default value 5px for goTop button
        let defaultMarginRightGoTop = 5;
        let goTop = document.getElementById('js-scroll-to-top');

        if (marginRight === '0px' || marginRight === '') {
            let scrollbarWidth = window.innerWidth - document.body.clientWidth;
            document.body.style.marginRight = scrollbarWidth + 'px';
            //Prevent move goTopButton
            goTop.style.marginRight = scrollbarWidth + defaultMarginRightGoTop + 'px';
        } else {
            document.body.style.marginRight = '0px';
            goTop.style.marginRight = defaultMarginRightGoTop + 'px';
        }
    }
}

window.addEventListener('load', function () {
   let preloader = document.querySelector('.preloader');
   if (typeof preloader !== 'undefined' && preloader) {
       preloader.hide();
       setTimeout(function () {
           preloader.style.display = 'none';
       }, 600);
   }
});

main();