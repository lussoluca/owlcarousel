<?php

namespace Drupal\owlcarousel\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\owlcarousel\Entity\OwlCarouselStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class OwlCarouselStyleBaseForm
 */
class OwlCarouselStyleBaseForm extends EntityForm {

  /**
   * The Owl carousel style entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $owlCarouselStyleStorage;

  /**
   * Constructs a base class for image style add and edit forms.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $owl_carousel_style_storage
   *   The Owl carousel style entity storage.
   */
  public function __construct(EntityStorageInterface $owl_carousel_style_storage) {
    $this->owlCarouselStyleStorage = $owl_carousel_style_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')->getStorage('owl_carousel_style')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    /** @var OwlCarouselStyle $entity */
    $entity = $this->entity;
/*
    $form['wrapper'] = [
      '#prefix' => '<div class="settings">',
    ];

    $form['tabswrapper'] = [
      '#prefix' => '<ul class="settings__tabs js-tabs">' .
                      '<li class="settings__tab is--active">' .
                        '<span class="settings__link" data-target="items">' . t('General') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="responsive">' . t('Responsive') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="theme">' . t('Theme') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="navigation">' . t('Navigation') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="behaviour">' . t('Behaviours') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="plugins">' . t('Plugins') . '</span>' .
                      '</li>' .
                      '<li class="settings__tab">' .
                        '<span class="settings__link" data-target="advanced">' . t('Advanced') . '</span>' .
                      '</li>' .
                    '</ul>',
    ];

    $form['tabscontainer'] = [
      '#prefix' => '<div class="settings__contentainer">',
    ];

    $form['itemcontainer'] = [
      '#prefix' => '<div class="settings__content is--active" data-target="items">',
    ];
*/
    $form['owlsettings'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    /* css settings and fallbacks */
    $form['general'] = [
      '#type' => 'details',
      '#title' => t('General Settings'),
      '#group' => 'owlsettings',
    ];

    $form['general']['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Carousel preset name'),
      '#default_value' => $entity->label(),
      '#description' => $this->t('The name of this owlCarousel preset.'),
      '#required' => TRUE,
      '#group' => 'general',
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['general']['name'] = [
      '#type' => 'machine_name',
      '#machine_name' => [
        'exists' => [$this->owlCarouselStyleStorage, 'load'],
      ],
      '#default_value' => $entity->id(),
      '#required' => TRUE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#group' => 'general',
    ];
    $form['general']['items'] = [
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width'),
      '#default_value' => $entity->getItems(),
      '#required' => TRUE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];

    /** if breakpoints are defined via breakpoints module
     *      read breakpoints and assing a single items number for each of them
     *
     *  else
     *      display 5 default couples of media query - items number
     *
     *  warning: some settings can be changed under each "responsive mode"
     *
     *          options
     *
     *            tabs for each media query and a "default" tab
     *
     */

    /* responsive settings */
    $form['responsive'] = [
      '#type' => 'details',
      '#title' => t('responsive settings'),
      '#group' => 'owlsettings',
    ];

    $form['responsive']['responsive'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable OwlCarousel responsive behaviour'),
      '#description' => $this->t('Can be set to false to remove responsive capabilities. <a href="http://www.owlcarousel.owlgraphic.com/demos/responsive.html">Demo</a>'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];

    $form['responsive']['mqone'] = [
      '#markup' => '<h3>Items Mobile</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequeryone'] = [
      '#type' => 'number',
      '#description' => $this->t('Mobile media query.'),
      '#default_value' => $entity->getResponsivequeryone(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemone'] = [
      '#type' => 'number',
      '#description' => $this->t('Mobile items.'),
      '#default_value' => $entity->getResponsiveitemone(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['mqtwo'] = [
      '#markup' => '<h3>Items Tablet portrait</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequerytwo'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet portrait media query.'),
      '#default_value' => $entity->getResponsivequerytwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemtwo'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet portrait items.'),
      '#default_value' => $entity->getResponsiveitemtwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['mqthree'] = [
      '#markup' => '<h3>Items Tablet landscape</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequerythree'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet landscape media query.'),
      '#default_value' => $entity->getResponsivequerythree(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemthree'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet landscape items.'),
      '#default_value' => $entity->getResponsiveitemthree(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['mqfour'] = [
      '#markup' => '<h3>Items Desktop small</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequeryfour'] = [
      '#type' => 'number',
      '#description' => $this->t('Small desktop media query.'),
      '#default_value' => $entity->getResponsivequeryfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemfour'] = [
      '#type' => 'number',
      '#description' => $this->t('Small desktop items.'),
      '#default_value' => $entity->getResponsiveitemfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['mqfive'] = [
      '#markup' => '<h3>Items Desktop large</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequeryfive'] = [
      '#type' => 'number',
      '#description' => $this->t('Large desktop media query.'),
      '#default_value' => $entity->getResponsivequeryfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemfive'] = [
      '#type' => 'number',
      '#description' => $this->t('Large desktop items.'),
      '#default_value' => $entity->getResponsiveitemfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiverefreshrate'] = [
      '#type' => 'number',
      '#title' => $this->t('Responsive refresh rate.'),
      '#default_value' => $entity->getResponsiverefreshrate() ?: 200,
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsivebaseelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Responsive base element. Set on any DOM element.'),
      '#description' => $this->t('If you care about non responsive browser (like ie8) then use it on main wrapper. This will prevent from crazy resizing.'),
      '#default_value' => $entity->getResponsivebaseelement() ?: 'window',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveclass'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable optional helper class. '),
      '#description' => $this->t('Add "owl-reponsive-" + "breakpoint" class to main element. Can be used to stylize content on given breakpoint'),
      '#default_value' => $entity->getResponsivebaseelement() ?: TRUE,
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];

    /* theme settings */
    $form['theme'] = [
      '#type' => 'details',
      '#title' => t('Theme settings'),
      '#group' => 'owlsettings',
    ];
    $form['theme']['themeclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Theme class.'),
      '#description' => $this->t('define a theme using a theme class. E.g. "default".'),
      '#default_value' => $entity->getThemeclass() ?: 'owl-theme',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['baseclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Base class'),
      '#description' => $this->t('Base element class.'),
      '#default_value' => $entity->getBaseclass() ?: 'owl-carousel',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['stageelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Stage Element'),
      '#description' => $this->t('Sets a DOM element type for owl-stage.'),
      '#default_value' => $entity->getStageelement() ?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['itemclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Item class'),
      '#description' => $this->t('Set a class for the item element'),
      '#default_value' => $entity->getItemclass() ?: 'owl-item',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['itemelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Item element'),
      '#description' => $this->t('DOM element type for owlCarousel items.'),
      '#default_value' => $entity->getItemelement() ?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['nesteditemelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nested item elements class'),
      '#description' => $this->t('Use it if owl items are deep nasted inside some generated content. E.g "youritem".'),
      '#default_value' => $entity->getNesteditemselector(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['controlsclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Controls Class'),
      '#description' => $this->t('Sets a class for the wrapper of "prev/next" navigation and dots navigation.'),
      '#default_value' => $entity->getControlsclass() ?: 'owl-controls',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['dotclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dot class'),
      '#description' => $this->t('Set a class for the dot element'),
      '#default_value' => $entity->getDotclass() ?: 'owl-dot',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['dotscontainer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('dotsContainer'),
      '#description' => $this->t('Set your own DOM element as container for dots navigation.'),
      '#default_value' => $entity->getDotscontainer() ?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['dotsclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dots container class'),
      '#description' => $this->t('Set a class for the dots container element'),
      '#default_value' => $entity->getDotsclass() ?: 'owl-dots',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['navcontainerclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Navigation container class'),
      '#default_value' => $entity->getNavcontainerclass() ?: 'owl-nav',
      '#description' => $this->t('Set a class for the navigation container element'),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['navcontainer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Navigation container element'),
      '#description' => $this->t('Set your own DOM element as container for "prev/next" navigation.'),
      '#default_value' => $entity->getNavcontainer() ?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['navclassprev'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Navigation buttons class for "prev"'),
      '#default_value' => $entity->getNavclassprev() ?: 'owl-prev',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['navclassnext'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Navigation buttons class for "next".'),
      '#default_value' => $entity->getNavclassnext() ?: 'owl-next',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['centerclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Center class.'),
      '#description' => $this->t('If center is enabled this class will be added'),
      '#default_value' => $entity->getCenterclass() ?: 'center',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['activeclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Active class'),
      '#description' => $this->t('This class will be added to the active element.'),
      '#default_value' => $entity->getActiveclass() ?: 'active',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['autoheightclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Auto height Class.'),
      '#description' => $this->t('If autoheight is enabled this class will be added'),
      '#default_value' => $entity->getAutoheightclass() ?: 'owl-height',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['margin'] = [
      '#type' => 'number',
      '#title' => $this->t('Item margin'),
      '#description' => $this->t('margin-right(px) on item.'),
      '#default_value' => $entity->getMargin() ?: 0,
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['stagpadding'] = [
      '#type' => 'number',
      '#title' => $this->t('Stage padding'),
      '#description' => $this->t('Padding left and right on stage (can see neighbours). <a href="http://www.owlcarousel.owlgraphic.com/demos/stagepadding.html">demo</a>'),
      '#default_value' => $entity->getStagepadding() ?: 0,
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];

    /* css settings and fallbacks */
    $form['css3animations'] = [
      '#type' => 'details',
      '#title' => t('CSS settings and fallbacks'),
      '#group' => 'owlsettings',
    ];

    $form['css3animations']['animateout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CSS3 animation out.'),
      '#default_value' => $entity->getAnimateout(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['css3animations']['animatein'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CSS3 animation in.'),
      '#default_value' => $entity->getAnimatein(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['css3animations']['fallbackeasing'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Easing for CSS2 $.animate.'),
      '#default_value' => $entity->getFallbackeasing(),
      '#required' => FALSE,
    ];

    /* css settings and fallbacks */
    $form['navigation'] = [
      '#type' => 'details',
      '#title' => t('Navigation settings'),
      '#group' => 'owlsettings',
    ];

    $form['navigation']['nav'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Navigation, showing next/prev buttons.'),
      '#default_value' => $entity->getNav()?: TRUE,
      '#required' => FALSE,
    ];
    $form['navigation']['navrewind'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable "first" and "last" links'),
      '#default_value' => $entity->getNavrewind()?: TRUE,
      '#required' => FALSE,
    ];
    $form['navigation']['navtextprev'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for "previous" navigation element'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextprev()?: 'prev',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['navigation']['navtextnext'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for "next" navigation element'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextnext()?: 'prev',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['navigation']['slideby'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Elements to slide with navigation'),
      '#description' => $this->t('Navigation slide by x. "page" textfield can be set to slide by page.'),
      '#default_value' => $entity->getSlideby() ?: 'page',
      '#required' => FALSE,
    ];
    $form['navigation']['dots'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Dots navigation'),
      '#default_value' => $entity->getDots()?: FALSE,
      '#required' => FALSE,
    ];
    $form['navigation']['dotseach'] = [
      '#type' => 'number',
      '#title' => $this->t('Elements for Dot'),
      '#description' => $this->t('Show dots each x item.'),
      '#default_value' => $entity->getDotseach() ?: 1,
      '#required' => FALSE,
    ];
    $form['navigation']['dotdata'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable data-dot content'),
      '#description' => $this->t('Used by data-dot content.'),
      '#default_value' => $entity->getDotdata() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['navigation']['startposition'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Slider start position'),
      '#description' => $this->t('Start position (number) or URL Hash textfield like "#id" (textfield).'),
      '#default_value' => $entity->getStartposition() ?: 0,
      '#required' => FALSE,
    ];

    /* autoplay */
    $form['autoplay'] = [
      '#type' => 'details',
      '#title' => t('Autoplay options'),
      '#group' => 'owlsettings',
    ];
    $form['autoplay']['autoplay'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoplay'),
      '#default_value' => $entity->getAutoplay() ?: TRUE,
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplayhoverpause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Pause on mouse hover.'),
      '#default_value' => $entity->getAutoplayhoverpause() ?: TRUE,
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplayspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('Autoplay speed.'),
      '#description' => $this->t('milliseconds'),
      '#default_value' => $entity->getAutoplayspeed(),
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplaytimeout'] = [
      '#type' => 'number',
      '#title' => $this->t('Autoplay interval timeout.'),
      '#description' => $this->t('milliseconds. e.g. 5000 = 5s'),
      '#default_value' => $entity->getAutoplaytimeout() ?: '5000',
      '#required' => FALSE,
    ];

    /* Interactions */
    $form['interactions'] = [
      '#type' => 'details',
      '#title' => t('Interaction'),
      '#group' => 'owlsettings',
    ];
    $form['interactions']['mousedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $entity->getMousedrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['touchdrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('touchDrag'),
      '#description' => $this->t('Touch drag enabled'),
      '#default_value' => $entity->getTouchdrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['pulldrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('pullDrag'),
      '#description' => $this->t('Pull drag enabled'),
      '#default_value' => $entity->getPulldrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['freedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('freeDrag'),
      '#description' => $this->t('Free drag enabled'),
      '#default_value' => $entity->getFreedrag() ?: FALSE,
      '#required' => FALSE,
    ];

    /* behaviour*/
    $form['behaviour'] = [
      '#type' => 'details',
      '#title' => t('Items behaviour'),
      '#group' => 'owlsettings',
    ];
    $form['behaviour']['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Infinity Loop'),
      '#description' => $this->t('Duplicate last and first items to get loop illusion.'),
      '#default_value' => $entity->getLoop() ?: TRUE,
      '#required' => FALSE,
    ];
    $form['behaviour']['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Center items'),
      '#description' => $this->t('Works well with even an odd number of items. <a href="http://www.owlcarousel.owlgraphic.com/demos/center.html">Demo</a>'),
      '#default_value' => $entity->getCenter() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['merge'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Merge Items'),
      '#description' => $this->t('Looking for data-merge="{number}" inside item. <a href="http://www.owlcarousel.owlgraphic.com/demos/merge.html">Demo</a>'),
      '#default_value' => $entity->getMerge() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['mergefit'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Fit merged items'),
      '#description' => $this->t('If screen is smaller than items value owlCarousel will merge multiple items'),
      '#default_value' => $entity->getMergefit() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['autowidth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Autowidth'),
      '#description' => $this->t('Set non grid content. Try using width style on divs. <a href="http://www.owlcarousel.owlgraphic.com/demos/autowidth.html">Demo</a>'),
      '#default_value' => $entity->getAutowidth() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['rtl'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Rtl'),
      '#description' => $this->t('Change direction from Right to left <a href="http://www.owlcarousel.owlgraphic.com/demos/rtl.html">Demo</a>'),
      '#default_value' => $entity->getAutowidth() ?: FALSE,
      '#required' => FALSE,
    ];

    /* speed */
    $form['speed'] = [
      '#type' => 'details',
      '#title' => t('Speed settings'),
      '#group' => 'owlsettings',
    ];
    $form['speed']['smartspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplay'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getSmartspeed(),
      '#required' => FALSE,
    ];
    $form['speed']['fluidspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('fluidSpeed'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getFluidspeed(),
      '#required' => FALSE,
    ];
    $form['speed']['navspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('navSpeed'),
      '#description' => $this->t('Navigation speed'),
      '#default_value' => $entity->getNavspeed(),
      '#required' => FALSE,
    ];
    $form['speed']['dotsspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('dotsSpeed'),
      '#description' => $this->t('Pagination speed.'),
      '#default_value' => $entity->getDotsspeed(),
      '#required' => FALSE,
    ];
    $form['speed']['dragendspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('dragEndSpeed'),
      '#description' => $this->t('Drag end speed.'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];

    /* video plugin */
    $form['video'] = [
      '#type' => 'details',
      '#title' => t('Video plugin settings'),
      '#group' => 'owlsettings',
    ];
    $form['video']['video'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Video'),
      '#description' => $this->t('Enable fetching YouTube/Vimeo videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    ];
    $form['video']['videoheight'] = [
      '#type' => 'number',
      '#title' => $this->t('videoHeight'),
      '#description' => $this->t('Set height for videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    ];
    $form['video']['videowidth'] = [
      '#type' => 'number',
      '#title' => $this->t('videoWidth'),
      '#description' => $this->t('Set width for videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    ];

    /* lazyLoad plugin */
    $form['lazyload'] = [
      '#type' => 'details',
      '#title' => t('lazyLoad plugin settings'),
      '#group' => 'owlsettings',
    ];

    $form['lazyload']['lazyload'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Lazy load'),

      '#description' => $this->t('Lazy load images. data-src and data-src-retina for highres. Also load images into background inline style if element is not <img>'),
      '#default_value' => $entity->getLazyload(),
      '#required' => FALSE,
    ];
    $form['lazyload']['lazycontent'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Lazy load content'),

      '#description' => $this->t('lazyContent was introduced during beta tests but i removed it from the final release due to bad implementation. It is a nice options so i will work on it in the nearest feature.'),
      '#default_value' => $entity->getLazycontent(),
      '#required' => FALSE,
    ];

    /* Advanced */
    $form['advanced'] = [
      '#type' => 'details',
      '#title' => t('Advanced options'),
      '#group' => 'owlsettings',
    ];
    $form['advanced']['urlhashlistener'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('URLhashListener'),
      '#description' => $this->t('Listen to url hash changes. data-hash on items is required. <a href="http://www.owlcarousel.owlgraphic.com/demos/urlhashnav.html">Demo</a>'),
      '#default_value' => $entity->getUrlhashlistener() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['advanced']['callbacks'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('callbacks'),
      '#description' => $this->t('Enable callback events.'),
      '#default_value' => $entity->getCallbacks() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['advanced']['info'] = [
      '#type' => 'textarea',
      '#title' => $this->t('info'),
      '#description' => $this->t('Callback to retrieve basic information (current item/pages/widths). Info function second parameter is Owl DOM object reference.'),
      '#default_value' => $entity->getInfo(),
      '#required' => FALSE,
    ];

    $form['#attached']['library'][] = 'owlcarousel/owlsettings';

    return parent::form($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);
    $form_state->setRedirectUrl($this->entity->urlInfo('collection'));
  }
}
