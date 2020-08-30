function main() {(function () {
        'use strict';

        //Scroll page to selected menu item
        $('a.page-scroll').click(function () {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - 105
                    }, 900);
                    return false;
                }
            }
        });

        // Show Menu on Book
        //Show background for menu
        window.addEventListener('scroll', function() {
            //var y = $(this).scrollTop();
            const y = function () {
                return window.scrollY;
            };
            const $navbar = document.getElementsByClassName('navbar')[0];
            if (y() > vh(20)) {
                $navbar.classList.add('top-menu');
                $navbar.style.transition = 'all 600ms ease-in';
            } else {
                $navbar.classList.remove('top-menu');
                $navbar.style.transition = 'all 500ms ease-in';
            }
        });

        function vh(v) {
            const h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
            return (v * h) / 100;
        }

        $('body').scrollspy({
            target: '.navbar',
            offset: 80
        });

        // Hide nav on click
        $(".navbar-nav li a").click(function (event) {
            // check if window is small enough so dropdown is created
            var toggle = $(".navbar-toggle").is(":visible");
            if (toggle) {
                $(".navbar-collapse").collapse('hide');
            }
        });

        // Portfolio isotope filter
        $(window).load(function () {
            var $container = $('.portfolio-items');
            $container.isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows',
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            $('.cat a').click(function () {
                $('.cat .active').removeClass('active');
                $(this).addClass('active');
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    itemSelector: '.portfolio-item',
                    layoutMode: 'fitRows',
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });

        });

        // Nivo Lightbox
        $('.portfolio-item a').nivoLightbox({
            effect: 'slideDown',
            keyboardNav: true,
        });

    }());
}

main();