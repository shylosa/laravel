function main() {
    //Scroll page to selected menu item
    const links = document.querySelectorAll(".menu__item");
    for (const link of links) {
        link.addEventListener("click", clickHandler);
    }

    function clickHandler(e) {
        e.preventDefault();
        const href = this.getAttribute("href");
        if (isValidUrl(href)) {
            window.location.href = href;
        } else {
            const offsetTop = document.querySelector(href).offsetTop;

            scroll({
                top: offsetTop,
                behavior: "smooth"
            });
        }
    }

    function isValidUrl(string) {
        try {
            new URL(string);
        } catch (_) {
            return false;
        }

        return true;
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