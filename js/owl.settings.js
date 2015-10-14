(function($, Drupal){
    Drupal.behaviors.owlCarouselTabsSettings = {
        attach: function (context) {
            var tabs = $('.js-tabs'),
                links = tabs.children(),
                target,
                responsive;
            links.on('click touchstart', function(e){
                el = $(e.target);
                target = $('[data-target=' + el.data().target + ']');
                el.parent().siblings().removeClass('is--active');
                el.parent().addClass('is--active');
                target.siblings().removeClass('is--active');
                target.addClass('is--active');
            });
        }
    }
    Drupal.behaviors.owlCarouselResponsiveSettings = {
        attach: function (context) {
            var trigger = $('.js-form-item-responsive'),
                target = trigger.siblings().find('input');

            function resSet(){
                trigger.attr('checked') === true ?
                    target.removeAttr('disabled').removeClass('is--disabled') :
                    target.attr('disabled', 'disabled').addClass('is--disabled');
            }

            trigger.on('change', function(){
                resSet();
            });

            resSet();

        }
    }
})(jQuery, Drupal);
