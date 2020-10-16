function main() {

    //Scroll page to selected menu item
    const links = document.querySelectorAll('.menu__item');
    for (const link of links) {
        link.addEventListener('click', menuItemsHandler);
    }
    document.getElementById('js-more-button').addEventListener('click', menuItemsHandler);

    function menuItemsHandler(e) {
        e.preventDefault();
        const href = this.getAttribute('href');

        if (isHasAnchorsOnCurrentPage() && isLinkHasHash(href)) {
            const offsetTop = document.querySelector(href).offsetTop;
            scroll({
                top: offsetTop,
                behavior: 'smooth'
            });
            if (e.target.getAttribute('id') === 'js-more-button') {
                return;
            }
            //Close menu bar
            toggleMenu();
            toggleLockScroll();
        } else if (!isLinkHasHash(href)) {
            window.location.href = href;
        } else {
            window.location.href = window.location.origin + '/' + getLocale() + href;
        }
    }

    function isHasAnchorsOnCurrentPage() {   // 1 - because footer has 'contacts' anchor
        return document.querySelectorAll('.js-anchor').length > 1;
    }

    function isLinkHasHash(href) {
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

    window.addEventListener('scroll', showScrollToTopLink);

    function showScrollToTopLink() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            scrollToTopLink.style.display = 'block';
        } else {
            scrollToTopLink.style.display = 'none';
        }
    }

    //Open menu and lock page scroll
    document.getElementById('menu__toggle').addEventListener('click', toggleHandler);

    function toggleHandler() {
        toggleMenu();
        toggleLockScroll();
    }

    function toggleLockScroll() {
        let pageClass = document.body.classList;
        let jsClass = 'js-disable-scroll';
        if (pageClass.contains(jsClass)) {
            pageClass.remove(jsClass);
        } else {
            pageClass.add(jsClass);
        }
    }

    function toggleMenu()
    {
        let burgerClass = document.getElementById('menu__toggle').classList;
        let jsChecked = 'js-checked';
        if (burgerClass.contains(jsChecked)) {
            burgerClass.remove(jsChecked);
        } else {
            burgerClass.add(jsChecked);
        }
    }
}

main();