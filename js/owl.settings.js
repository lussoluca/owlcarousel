/**
 * @file
 * Initiate Owl Carousel.
 */

(function ($) {

    Drupal.behaviors.owlCarousel = {
        attach: function (context, settings) {

            for (var carousel in settings.owlcarousel) {
                // Carousel instance.
                var owl = $('.js-owlCarousel--' + carousel);

                // lazyLoad support.
                if (settings.owlcarousel[carousel].settings.lazyLoad) {
                    var images = owl.find('img');

                    $.each(images, function(i, image) {
                        $(image).attr('data-src', $(image).attr('src'));
                    });

                    images.addClass('owl-lazy');
                }

                // Attach instance settings.
                owl.owlCarousel(settings.owlcarousel[carousel].settings);
            }
        }
    }
})(jQuery);
