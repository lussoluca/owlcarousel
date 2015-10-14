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

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image style name'),
      '#default_value' => $entity->label(),
      '#required' => TRUE,
    ];
    $form['name'] = [
      '#type' => 'machine_name',
      '#machine_name' => [
        'exists' => [$this->owlCarouselStyleStorage, 'load'],
      ],
      '#default_value' => $entity->id(),
      '#required' => TRUE,
    ];
    $form['items'] = [
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width'),
      '#default_value' => $entity->getItems(),
      '#required' => TRUE,
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
    $form['responsive'] = [
      '#type' => 'details',
      '#title' => t('Responsive'),
      '#open' => FALSE,
    ];
    $form['responsive']['responsive'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Responsive'),
      '#description' => $this->t('Object containing responsive options. Can be set to false to remove responsive capabilities.'),
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
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemone'] = [
      '#type' => 'number',
      '#description' => $this->t('Mobile items.'),
      '#default_value' => $entity->getResponsiveitemone(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['responsive']['mqtwo'] = [
      '#markup' => '<h3>Items Tablet portrait</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequerytwo'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet portrait media query.'),
      '#default_value' => $entity->getResponsivequerytwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemtwo'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet portrait items.'),
      '#default_value' => $entity->getResponsiveitemtwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['responsive']['mqthree'] = [
      '#markup' => '<h3>Items Tablet landscape</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequerythree'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet landscape media query.'),
      '#default_value' => $entity->getResponsivequerythree(),
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemthree'] = [
      '#type' => 'number',
      '#description' => $this->t('Tablet landscape items.'),
      '#default_value' => $entity->getResponsiveitemthree(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['responsive']['mqfour'] = [
      '#markup' => '<h3>Items Desktop small</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequeryfour'] = [
      '#type' => 'number',
      '#description' => $this->t('Small desktop media query.'),
      '#default_value' => $entity->getResponsivequeryfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemfour'] = [
      '#type' => 'number',
      '#description' => $this->t('Small desktop items.'),
      '#default_value' => $entity->getResponsiveitemfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['responsive']['mqfive'] = [
      '#markup' => '<h3>Items Desktop large</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsivequeryfive'] = [
      '#type' => 'number',
      '#description' => $this->t('Large desktop media query.'),
      '#default_value' => $entity->getResponsivequeryfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitemfive'] = [
      '#type' => 'number',
      '#description' => $this->t('Large desktop items.'),
      '#default_value' => $entity->getResponsiveitemfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['responsive']['responsiverefreshrate'] = [
      '#type' => 'number',
      '#title' => $this->t('responsiveRefreshRate'),
      '#description' => $this->t('Responsive refresh rate.'),
      '#default_value' => $entity->getResponsiverefreshrate()?: 200,
      '#required' => FALSE,
    ];
    $form['responsive']['responsivebaseelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('responsiveBaseElement'),
      '#description' => $this->t('Set on any DOM element. If you care about non responsive browser (like ie8) then use it on main wrapper. This will prevent from crazy resizing.'),
      '#default_value' => $entity->getResponsivebaseelement() ?: 'window',
      '#required' => FALSE,
    ];
    $form['responsive']['responsiveclass'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('responsiveClass'),
      '#description' => $this->t('Optional helper class. Add "owl-reponsive-" + "breakpoint" class to main element. Can be used to stylize content on given breakpoint'),
      '#default_value' => $entity->getResponsivebaseelement()?: TRUE,
      '#required' => FALSE,
    ];

    /* behaviour*/
    $form['behaviour'] = [
      '#type' => 'details',
      '#title' => t('Behaviour'),
      '#open' => FALSE,
    ];
    $form['behaviour']['margin'] = [
      '#type' => 'number',
      '#title' => $this->t('Margin'),
      '#description' => $this->t('margin-right(px) on item.'),
      '#default_value' => $entity->getMargin()?: 0,
      '#required' => FALSE,
    ];
    $form['behaviour']['stagpadding'] = [
      '#type' => 'number',
      '#title' => $this->t('stagePadding'),
      '#description' => $this->t('Padding left and right on stage (can see neighbours).'),
      '#default_value' => $entity->getStagepadding()?: 0,
      '#required' => FALSE,
    ];
    $form['behaviour']['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Infinite Loop'),
      '#description' => $this->t('Inifnity loop. Duplicate last and first items to get loop illusion.'),
      '#default_value' => $entity->getLoop()?: TRUE,
      '#required' => FALSE,
    ];
    $form['behaviour']['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Center'),
      '#description' => $this->t('Center item. Works well with even an odd number of items.'),
      '#default_value' => $entity->getCenter()?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['merge'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('merge'),
      '#description' => $this->t('Merge items. Looking for data-merge="{number}" inside item.'),
      '#default_value' => $entity->getMerge()?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['mergefit'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mergeFit'),
      '#description' => $this->t('Fit merged items if screen is smaller than items value.'),
      '#default_value' => $entity->getMergefit()?: FALSE,
      '#required' => FALSE,
    ];
    $form['behaviour']['autowidth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('autoWidth'),
      '#description' => $this->t('Set non grid content. Try using width style on divs.'),
      '#default_value' => $entity->getAutowidth()?: FALSE,
      '#required' => FALSE,
    ];

    /* autoplay */
    $form['autoplay'] = [
      '#type' => 'details',
      '#title' => t('Autoplay options'),
      '#open' => FALSE,
    ];
    $form['autoplay']['autoplay'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoplay'),
      '#description' => $this->t('Autoplay.'),
      '#default_value' => $entity->getAutoplay()?: TRUE,
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplayspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplaySpeed'),
      '#description' => $this->t('Autoplay speed.'),
      '#default_value' => $entity->getAutoplayspeed(),
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplaytimeout'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplaytimeout'),
      '#description' => $this->t('Autoplay interval timeout.'),
      '#default_value' => $entity->getAutoplaytimeout()?: '5000',
      '#required' => FALSE,
    ];
    $form['autoplay']['autoplayhoverpause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('autoplayHovePause'),
      '#description' => $this->t('Pause on mouse hover.'),
      '#default_value' => $entity->getAutoplayhoverpause()?: TRUE,
      '#required' => FALSE,
    ];

    /* navigation */
    $form['navigation'] = [
      '#type' => 'details',
      '#title' => t('Navigation options'),
      '#open' => TRUE,
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
    ];
    $form['navigation']['navtextnext'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for "next" navigation element'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextnext()?: 'prev',
      '#required' => FALSE,
    ];
    $form['navigation']['slideby'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Elements to slide with navigation'),
      '#description' => $this->t('Navigation slide by x. "page" textfield can be set to slide by page.'),
      '#default_value' => $entity->getSlideby()?: 'page',
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
      '#default_value' => $entity->getDotseach()?: 1,
      '#required' => FALSE,
    ];
    $form['navigation']['dotdata'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable data-dot content'),
      '#description' => $this->t('Used by data-dot content.'),
      '#default_value' => $entity->getDotdata()?: FALSE,
      '#required' => FALSE,
    ];
    $form['navigation']['startposition'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Slider start position'),
      '#description' => $this->t('Start position (number) or URL Hash textfield like "#id" (textfield).'),
      '#default_value' => $entity->getStartposition()?: 0,
      '#required' => FALSE,
    ];

    /* Interactions */
    $form['interactions'] = [
      '#type' => 'details',
      '#title' => t('Interaction'),
      '#open' => TRUE,
    ];
    $form['interactions']['mousedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $entity->getMousedrag()?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['touchdrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('touchDrag'),
      '#description' => $this->t('Touch drag enabled'),
      '#default_value' => $entity->getTouchdrag()?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['pulldrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('pullDrag'),
      '#description' => $this->t('Pull drag enabled'),
      '#default_value' => $entity->getPulldrag()?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['freedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('freeDrag'),
      '#description' => $this->t('Free drag enabled'),
      '#default_value' => $entity->getFreedrag()?: FALSE,
      '#required' => FALSE,
    ];

    /* speed */
    $form['speed'] = [
      '#type' => 'details',
      '#title' => t('Speed settings'),
      '#open' => FALSE,
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

    /* theme settings and css3 */
    $form['themetitle'] = [
      '#markup' => '<h3>Theme settings and CSS3 settings</h3>',
    ];

    /* theme settings */
    $form['theme'] = [
      '#type' => 'details',
      '#title' => t('Theme'),
      '#open' => FALSE,
    ];
    $form['theme']['themeclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('themeClass'),
      '#description' => $this->t('Theme class.'),
      '#default_value' => $entity->getThemeclass() ?: 'owl-theme',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['baseclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('baseClass'),
      '#description' => $this->t('Base element class.'),
      '#default_value' => $entity->getBaseclass() ?: 'owl-carousel',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['stageelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('stageElement'),
      '#description' => $this->t('DOM element type for owl-stage.'),
      '#default_value' => $entity->getStageelement()?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['itemclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemClass'),
      '#description' => $this->t('Item class.'),
      '#default_value' => $entity->getItemclass() ?: 'owl-item',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['itemelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('itemElement'),
      '#description' => $this->t('DOM element type for owl-item.'),
      '#default_value' => $entity->getItemelement()?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['nesteditemelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('nestedItemElement'),
      '#description' => $this->t('Use it if owl items are deep nasted inside some generated content. E.g "youritem". Don\'t use dot before class name.'),
      '#default_value' => $entity->getNesteditemselector(),
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['controlsclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('controlsClass'),
      '#description' => $this->t('Controls Class - wrapper for navs and dots.'),
      '#default_value' => $entity->getControlsclass() ?: 'owl-controls',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['dotclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('dotClass'),
      '#description' => $this->t('Dot Class'),
      '#default_value' => $entity->getDotclass() ?: 'owl-dot',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['dotsclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('dotsClass'),
      '#description' => $this->t('Dots Class - Container for dots.'),
      '#default_value' => $entity->getDotsclass() ?: 'owl-dots',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['dotscontainer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('dotsContainer'),
      '#description' => $this->t('Set your own container for nav.'),
      '#default_value' => $entity->getDotscontainer()?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['navcontainerclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('navContainerClass'),
      '#description' => $this->t('Nav container class.'),
      '#default_value' => $entity->getNavcontainerclass() ?: 'owl-nav',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['navclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('navClass'),
      '#description' => $this->t('Nav buttons class.'),
      '#default_value' => $entity->getNavclass() ?: '[&#x27;owl-prev&#x27;,&#x27;owl-next&#x27;]',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['navcontainer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('navContainer'),
      '#description' => $this->t('Set your own container for nav.'),
      '#default_value' => $entity->getNavcontainer()?: 'div',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['centerclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('centerClass'),
      '#description' => $this->t('Center class.'),
      '#default_value' => $entity->getCenterclass() ?: 'center',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['activeclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('activeClass'),
      '#description' => $this->t('Active class.'),
      '#default_value' => $entity->getActiveclass() ?: 'active',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];
    $form['theme']['autoheightclass'] = [
      '#type' => 'textfield',
      '#title' => $this->t('autoheightclass'),
      '#description' => $this->t('Auto height Class.'),
      '#default_value' => $entity->getAutoheightclass() ?: 'owl-height',
      '#required' => FALSE,
      '#prefix' => '<div class="clearfix"><div class="2/2">',
      '#suffix' => '</div></div>',
    ];

    /* css settings and fallbacks */
    $form['css3animations'] = [
      '#type' => 'details',
      '#title' => t('CSS3 animations'),
      '#open' => FALSE,
    ];
    $form['css3animations']['animateout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('animateOut'),
      '#description' => $this->t('CSS3 animation out.'),
      '#default_value' => $entity->getAnimateout(),
      '#required' => FALSE,
    ];
    $form['css3animations']['animatein'] = [
      '#type' => 'textfield',
      '#title' => $this->t('animateIn'),
      '#description' => $this->t('CSS3 animation in.'),
      '#default_value' => $entity->getAnimatein(),
      '#required' => FALSE,
    ];
    $form['css3animations']['fallbackeasing'] = [
      '#type' => 'textfield',
      '#title' => $this->t('fallbackEasing'),
      '#description' => $this->t('Easing for CSS2 $.animate.'),
      '#default_value' => $entity->getFallbackeasing(),
      '#required' => FALSE,
    ];

    /* plugins settings and advanced options */
    $form['plugintitle'] = [
      '#markup' => '<h3>Plugins and advanced options</h3>',
    ];

    /* video plugin */
    $form['video'] = [
      '#type' => 'details',
      '#title' => t('Video plugin settings'),
      '#open' => FALSE,
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
      '#open' => FALSE,
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
      '#open' => FALSE,
    ];
    $form['advanced']['urlhashlistener'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('URLhashListener'),
      '#description' => $this->t('Listen to url hash changes. data-hash on items is required.'),
      '#default_value' => $entity->getUrlhashlistener()?: FALSE,
      '#required' => FALSE,
    ];
    $form['advanced']['callbacks'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('callbacks'),
      '#description' => $this->t('Enable callback events.'),
      '#default_value' => $entity->getCallbacks()?: FALSE,
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
