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
      '#type' => 'checkbox',
      '#title' => $this->t('Responsive'),
      '#description' => $this->t('Object containing responsive options. Can be set to false to remove responsive capabilities.'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];


    $form['responsiverefreshrate'] = [
      '#type' => 'number',
      '#title' => $this->t('responsiveRefreshRate'),
      '#description' => $this->t('Responsive refresh rate.'),
      '#default_value' => $entity->getResponsiverefreshrate(),
      '#required' => FALSE,
    ];
    $form['responsivebaseelement'] = [
      '#type' => 'number',
      '#title' => $this->t('responsiveBaseElement'),
      '#description' => $this->t('Set on any DOM element. If you care about non responsive browser (like ie8) then use it on main wrapper. This will prevent from crazy resizing.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    ];
    $form['responsiveclass'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('responsiveClass'),
      '#description' => $this->t('Optional helper class. Add "owl-reponsive-" + "breakpoint" class to main element. Can be used to stylize content on given breakpoint'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    ];

    $form['margin'] = [
      '#type' => 'number',
      '#title' => $this->t('Margin'),
      '#description' => $this->t('margin-right(px) on item.'),
      '#default_value' => $entity->getMargin(),
      '#required' => FALSE,
    ];
    $form['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Infinite Loop'),
      '#description' => $this->t('Inifnity loop. Duplicate last and first items to get loop illusion.'),
      '#default_value' => $entity->getLoop(),
      '#required' => FALSE,
    ];
    $form['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Center'),
      '#description' => $this->t('Center item. Works well with even an odd number of items.'),
      '#default_value' => $entity->getCenter(),
      '#required' => FALSE,
    ];
    $form['mousedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $entity->getMousedrag(),
      '#required' => FALSE,
    ];
    $form['touchdrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('touchDrag'),
      '#description' => $this->t('Touch drag enabled'),
      '#default_value' => $entity->getTouchdrag(),
      '#required' => FALSE,
    ];
    $form['pulldrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('pullDrag'),
      '#description' => $this->t('Pull drag enabled'),
      '#default_value' => $entity->getPulldrag(),
      '#required' => FALSE,
    ];
    $form['freedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('freeDrag'),
      '#description' => $this->t('Free drag enabled'),
      '#default_value' => $entity->getFreedrag(),
      '#required' => FALSE,
    ];
    $form['stagpadding'] = [
      '#type' => 'number',
      '#title' => $this->t('stagePadding'),
      '#description' => $this->t('Padding left and right on stage (can see neighbours).'),
      '#default_value' => $entity->getStagepadding(),
      '#required' => FALSE,
    ];
    $form['merge'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('merge'),
      '#description' => $this->t('Merge items. Looking for data-merge="{number}" inside item.'),
      '#default_value' => $entity->getMerge(),
      '#required' => FALSE,
    ];
    $form['mergefit'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('mergeFit'),
      '#description' => $this->t('Fit merged items if screen is smaller than items value.'),
      '#default_value' => $entity->getMergefit(),
      '#required' => FALSE,
    ];
    $form['autowidth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('autoWidth'),
      '#description' => $this->t('Set non grid content. Try using width style on divs.'),
      '#default_value' => $entity->getAutowidth(),
      '#required' => FALSE,
    ];
    $form['startposition'] = [
      '#type' => 'textfield',
      '#title' => $this->t('mergeFit'),
      '#description' => $this->t('Start position (number) or URL Hash textfield like "#id" (textfield).'),
      '#default_value' => $entity->getStartposition(),
      '#required' => FALSE,
    ];
    $form['urlhashlistener'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('URLhashListener'),
      '#description' => $this->t('Listen to url hash changes. data-hash on items is required.'),
      '#default_value' => $entity->getUrlhashlistener(),
      '#required' => FALSE,
    ];
    $form['nav'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('nav'),
      '#description' => $this->t('Show next/prev buttons.'),
      '#default_value' => $entity->getNav(),
      '#required' => FALSE,
    ];
    $form['navrewind'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('navRewind'),
      '#description' => $this->t('Show next/prev buttons.'),
      '#default_value' => $entity->getNavrewind(),
      '#required' => FALSE,
    ];
    $form['navtextprev'] = [
      '#type' => 'textfield',
      '#title' => $this->t('nav text: prev'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextprev(),
      '#required' => FALSE,
    ];
    $form['navtextnext'] = [
      '#type' => 'textfield',
      '#title' => $this->t('nav text: next'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextnext(),
      '#required' => FALSE,
    ];
    $form['slideby'] = [
      '#type' => 'textfield',
      '#title' => $this->t('slideBy'),
      '#description' => $this->t('Navigation slide by x. "page" textfield can be set to slide by page.'),
      '#default_value' => $entity->getSlideby(),
      '#required' => FALSE,
    ];
    $form['dots'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Dots'),
      '#description' => $this->t('Show dots navigation.'),
      '#default_value' => $entity->getDots(),
      '#required' => FALSE,
    ];
    $form['dotseach'] = [
      '#type' => 'number',
      '#title' => $this->t('dotsEach'),
      '#description' => $this->t('Show dots each x item.'),
      '#default_value' => $entity->getDotseach(),
      '#required' => FALSE,
    ];
    $form['dotdata'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('dotData'),
      '#description' => $this->t('Used by data-dot content.'),
      '#default_value' => $entity->getDotdata(),
      '#required' => FALSE,
    ];

    $form['autoplay'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoplay'),
      '#description' => $this->t('Autoplay.'),
      '#default_value' => $entity->getAutoplay(),
      '#required' => FALSE,
    ];
    $form['autoplaytimeout'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplaytimeout'),
      '#description' => $this->t('Autoplay interval timeout.'),
      '#default_value' => $entity->getAutoplaytimeout(),
      '#required' => FALSE,
    ];
    $form['autoplayhoverpause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('autoplayHovePause'),
      '#description' => $this->t('Pause on mouse hover.'),
      '#default_value' => $entity->getAutoplayhoverpause(),
      '#required' => FALSE,
    ];
    $form['smartspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplay'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getSmartspeed(),
      '#required' => FALSE,
    ];
    $form['fluidspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('fluidSpeed'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getFluidspeed(),
      '#required' => FALSE,
    ];
    $form['autoplayspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('autoplaySpeed'),
      '#description' => $this->t('Autoplay speed.'),
      '#default_value' => $entity->getAutoplayspeed(),
      '#required' => FALSE,
    ];
    $form['navspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('navSpeed'),
      '#description' => $this->t('Navigation speed'),
      '#default_value' => $entity->getNavspeed(),
      '#required' => FALSE,
    ];
    $form['dotsspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('dotsSpeed'),
      '#description' => $this->t('Pagination speed.'),
      '#default_value' => $entity->getDotsspeed(),
      '#required' => FALSE,
    ];
    $form['dragendspeed'] = [
      '#type' => 'number',
      '#title' => $this->t('dragEndSpeed'),
      '#description' => $this->t('Drag end speed.'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];
    $form['callbacks'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('callbacks'),
      '#description' => $this->t('Enable callback events.'),
      '#default_value' => $entity->getCallbacks(),
      '#required' => FALSE,
    ];


    $form['info'] = [
      '#type' => 'textfield',
      '#title' => $this->t('info'),
      '#description' => $this->t('Callback to retrieve basic information (current item/pages/widths). Info function second parameter is Owl DOM object reference.'),
      '#default_value' => $entity->getInfo(),
      '#required' => FALSE,
    ];

    $form['nesteditemelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('nestedItemElement'),
      '#description' => $this->t('Use it if owl items are deep nasted inside some generated content. E.g "youritem". Dont use dot before class name.'),
      '#default_value' => $entity->getNesteditemselector(),
      '#required' => FALSE,
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
      '#default_value' => $entity->getStageelement(),
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
      '#default_value' => $entity->getItemelement(),
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
      '#default_value' => $entity->getNavcontainer(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div></div>',
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
      '#default_value' => $entity->getDotscontainer(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
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
    $form['csstitle'] = [
      '#markup' => '<h3>CSS settings and fallbacks</h3>',
    ];

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


    /* plugins settings */

    $form['plugintitle'] = [
      '#markup' => '<h3>Plugins</h3>',
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
      '#title' => $this->t('lazyLoad'),
      '#description' => $this->t('Lazy load images. data-src and data-src-retina for highres. Also load images into background inline style if element is not <img>'),
      '#default_value' => $entity->getLazyload(),
      '#required' => FALSE,
    ];
    $form['lazyload']['lazycontent'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('lazyContent'),
      '#description' => $this->t('lazyContent was introduced during beta tests but i removed it from the final release due to bad implementation. It is a nice options so i will work on it in the nearest feature.'),
      '#default_value' => $entity->getLazycontent(),
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
