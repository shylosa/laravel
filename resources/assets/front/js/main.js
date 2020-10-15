function main() {

    //Scroll page to selected menu item
    const links = document.querySelectorAll(".menu__item");
    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        e.preventDefault();
        const href = this.getAttribute("href");

        //Close menu bar
        document.getElementById('menu__toggle').checked = false;
        toggleLockScroll();

        if (isHasAnchorsOnCurrentPage() && isHasHash(href)) {
            const offsetTop = document.querySelector(href).offsetTop;
            scroll({
                top: offsetTop,
                behavior: "smooth"
            });
        } else if (!isHasHash(href)) {
            window.location.href = href;
        } else {
            window.location.href = window.location.origin + '/' + getLocale() + href;
        }
    }

    function isHasAnchorsOnCurrentPage()
    {   // 1 - because footer has 'contacts' anchor
        return document.querySelectorAll('.js-anchor').length > 1;
    }

    function isHasHash(href)
    {
        return href.indexOf("#") !== -1;
    }

    function getLocale()
    {
        let defaultLocale = 'ru';
        let locale = document.getElementsByTagName("html")[0].getAttribute("lang");
        if (typeof locale === 'string' && locale !== defaultLocale) {
            return locale;
        }

        return '';
    }

    //Scroll to top link
    const scrollToTopLink = document.getElementById('js-scroll-to-top');
    scrollToTopLink.addEventListener("click", function () {
        window.scroll({
            top: 0,
            behavior: 'smooth'
        });
    });

    window.addEventListener("scroll",function() {
        showScrollToTopLink();
    });
    function showScrollToTopLink() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            scrollToTopLink.style.display = "block";
        } else {
            scrollToTopLink.style.display = "none";
        }
    }

    //Lock page when menu is open
    const menuToggle = document.getElementById('menu__toggle');
    menuToggle.addEventListener('click', function () {
        let scrollPositionX = '0';
        let scrollPositionY = '0';
        if (localStorage.getItem('scrollPositionX') === null && localStorage.getItem('scrollPositionY') === null) {
            scrollPositionX = document.body.scrollLeft || document.documentElement.scrollLeft;
            scrollPositionY = document.body.scrollTop || document.documentElement.scrollTop;
            localStorage.setItem('scrollPositionX', scrollPositionX);
            localStorage.setItem('scrollPositionY', scrollPositionY);
        } else {
            scrollPositionX = parseInt(localStorage.getItem('scrollPositionX'));
            scrollPositionY = parseInt(localStorage.getItem('scrollPositionY'));
        }

        toggleLockScroll();
        window.scrollTo(scrollPositionX, scrollPositionY);
    });

    function toggleLockScroll()
    {
        let pageClass = document.body.classList;
        let jsClass = 'js-disable-scroll';

        if (pageClass.contains(jsClass)) {
            pageClass.remove(jsClass);
        } else {
            pageClass.add(jsClass);
        }
    }
}

main();