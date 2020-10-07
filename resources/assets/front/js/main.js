function main() {
    //Scroll page to selected menu item
    const links = document.querySelectorAll(".menu__item");
    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        e.preventDefault();
        const href = this.getAttribute("href");

        if (isHasAnchors()) {
            const offsetTop = document.querySelector(href).offsetTop;
            scroll({
                top: offsetTop,
                behavior: "smooth"
            });
        } else {
            window.location.href = window.location.origin + '/' + getLocale() + href;
        }
    }

    function isHasAnchors()
    {   // 1 - because footer has 'contacts' anchor
        return document.querySelectorAll('.js-anchor').length > 1;
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
        scrollFunction();
    });
    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            scrollToTopLink.style.display = "block";
        } else {
            scrollToTopLink.style.display = "none";
        }
    }
}

main();