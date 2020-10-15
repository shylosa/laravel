function main() {
    //Scroll page to selected menu item
    const links = document.querySelectorAll(".menu__item");
    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        e.preventDefault();
        const href = this.getAttribute("href");

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
    const scrollToTopLink = document.getElementsByClassName('js-scroll-to-top')[0];
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

    window.addEventListener('click', function (e) {
        //Lock page body when menu open
        if (e.target.getAttribute("id") === 'menu__toggle') {
            toggleLockScroll();
        }
        //Close menu bar
        if (e.target.classList.contains('menu__item')) {
            document.getElementById('menu__toggle').checked = false;
            toggleLockScroll();
        }
    });

    function toggleLockScroll()
    {
        let pageBody = document.body;
        let jsClass = 'js-disable-scroll';
        if (pageBody.classList.contains(jsClass) ) {
            pageBody.classList.remove(jsClass);
        } else {
            pageBody.classList.add(jsClass);
        }
    }
}

main();