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

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Image style name'),
      '#default_value' => $entity->label(),
      '#required' => TRUE,
    );
    $form['name'] = array(
      '#type' => 'machine_name',
      '#machine_name' => array(
        'exists' => array($this->owlCarouselStyleStorage, 'load'),
      ),
      '#default_value' => $entity->id(),
      '#required' => TRUE,
    );
    $form['items'] = array(
      '#type' => 'number',
      '#title' => $this->t('Items'),
      '#description' => $this->t('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width'),
      '#default_value' => $entity->getItems(),
      '#required' => TRUE,
    );
    $form['margin'] = array(
      '#type' => 'number',
      '#title' => $this->t('Margin'),
      '#description' => $this->t('margin-right(px) on item.'),
      '#default_value' => $entity->getMargin(),
      '#required' => FALSE,
    );
    $form['loop'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Infinite Loop'),
      '#description' => $this->t('Inifnity loop. Duplicate last and first items to get loop illusion.'),
      '#default_value' => $entity->getLoop(),
      '#required' => FALSE,
    );
    $form['center'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Center'),
      '#description' => $this->t('Center item. Works well with even an odd number of items.'),
      '#default_value' => $entity->getCenter(),
      '#required' => FALSE,
    );
    $form['mousedrag'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('mouseDrag'),
      '#description' => $this->t('Mouse drag enabled.'),
      '#default_value' => $entity->getMousedrag(),
      '#required' => FALSE,
    );
    $form['touchdrag'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('touchDrag'),
      '#description' => $this->t('Touch drag enabled'),
      '#default_value' => $entity->getTouchdrag(),
      '#required' => FALSE,
    );
    $form['pulldrag'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('pullDrag'),
      '#description' => $this->t('Pull drag enabled'),
      '#default_value' => $entity->getPulldrag(),
      '#required' => FALSE,
    );
    $form['freedrag'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('freeDrag'),
      '#description' => $this->t('Free drag enabled'),
      '#default_value' => $entity->getFreedrag(),
      '#required' => FALSE,
    );
    $form['stagpadding'] = array(
      '#type' => 'number',
      '#title' => $this->t('stagePadding'),
      '#description' => $this->t('Padding left and right on stage (can see neighbours).'),
      '#default_value' => $entity->getStagepadding(),
      '#required' => FALSE,
    );
    $form['merge'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('merge'),
      '#description' => $this->t('Merge items. Looking for data-merge="{number}" inside item.'),
      '#default_value' => $entity->getMerge(),
      '#required' => FALSE,
    );
    $form['mergefit'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('mergeFit'),
      '#description' => $this->t('Fit merged items if screen is smaller than items value.'),
      '#default_value' => $entity->getMergefit(),
      '#required' => FALSE,
    );
    $form['autowidth'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('autoWidth'),
      '#description' => $this->t('Set non grid content. Try using width style on divs.'),
      '#default_value' => $entity->getAutowidth(),
      '#required' => FALSE,
    );
    $form['startposition'] = array(
      '#type' => 'string',
      '#title' => $this->t('mergeFit'),
      '#description' => $this->t('Start position (number) or URL Hash string like "#id" (string).'),
      '#default_value' => $entity->getStartposition(),
      '#required' => FALSE,
    );
    $form['urlhashlistener'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('URLhashListener'),
      '#description' => $this->t('Listen to url hash changes. data-hash on items is required.'),
      '#default_value' => $entity->getUrlhashlistener(),
      '#required' => FALSE,
    );
    $form['nav'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('nav'),
      '#description' => $this->t('Show next/prev buttons.'),
      '#default_value' => $entity->getNav(),
      '#required' => FALSE,
    );
    $form['navrewind'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('navRewind'),
      '#description' => $this->t('Show next/prev buttons.'),
      '#default_value' => $entity->getNavrewind(),
      '#required' => FALSE,
    );
    $form['navtextprev'] = array(
      '#type' => 'string',
      '#title' => $this->t('nav text: prev'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextprev(),
      '#required' => FALSE,
    );
    $form['navtextnext'] = array(
      '#type' => 'string',
      '#title' => $this->t('nav text: next'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextnext(),
      '#required' => FALSE,
    );
    $form['slideby'] = array(
      '#type' => 'string',
      '#title' => $this->t('slideBy'),
      '#description' => $this->t('Navigation slide by x. "page" string can be set to slide by page.'),
      '#default_value' => $entity->getSlideby(),
      '#required' => FALSE,
    );
    $form['dots'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Dots'),
      '#description' => $this->t('Show dots navigation.'),
      '#default_value' => $entity->getDots(),
      '#required' => FALSE,
    );
    $form['dotseach'] = array(
      '#type' => 'number',
      '#title' => $this->t('dotsEach'),
      '#description' => $this->t('Show dots each x item.'),
      '#default_value' => $entity->getDotseach(),
      '#required' => FALSE,
    );
    $form['dotdata'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('dotData'),
      '#description' => $this->t('Used by data-dot content.'),
      '#default_value' => $entity->getDotdata(),
      '#required' => FALSE,
    );
    $form['lazyload'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('lazyLoad'),
      '#description' => $this->t('Lazy load images. data-src and data-src-retina for highres. Also load images into background inline style if element is not <img>'),
      '#default_value' => $entity->getLazyload(),
      '#required' => FALSE,
    );
    $form['lazycontent'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('lazyContent'),
      '#description' => $this->t('lazyContent was introduced during beta tests but i removed it from the final release due to bad implementation. It is a nice options so i will work on it in the nearest feature.'),
      '#default_value' => $entity->getLazycontent(),
      '#required' => FALSE,
    );
    $form['autoplay'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoplay'),
      '#description' => $this->t('Autoplay.'),
      '#default_value' => $entity->getAutoplay(),
      '#required' => FALSE,
    );
    $form['autoplaytimeout'] = array(
      '#type' => 'number',
      '#title' => $this->t('autoplaytimeout'),
      '#description' => $this->t('Autoplay interval timeout.'),
      '#default_value' => $entity->getAutoplaytimeout(),
      '#required' => FALSE,
    );
    $form['autoplayhoverpause'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('autoplayHovePause'),
      '#description' => $this->t('Pause on mouse hover.'),
      '#default_value' => $entity->getAutoplayhoverpause(),
      '#required' => FALSE,
    );
    $form['smartspeed'] = array(
      '#type' => 'number',
      '#title' => $this->t('autoplay'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getSmartspeed(),
      '#required' => FALSE,
    );
    $form['fluidspeed'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('fluidSpeed'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getFluidspeed(),
      '#required' => FALSE,
    );
    $form['autoplayspeed'] = array(
      '#type' => 'number',
      '#title' => $this->t('autoplaySpeed'),
      '#description' => $this->t('Autoplay speed.'),
      '#default_value' => $entity->getAutoplayspeed(),
      '#required' => FALSE,
    );
    $form['navspeed'] = array(
      '#type' => 'number',
      '#title' => $this->t('navSpeed'),
      '#description' => $this->t('Navigation speed'),
      '#default_value' => $entity->getNavspeed(),
      '#required' => FALSE,
    );
    $form['dotsspeed'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('dotsSpeed'),
      '#description' => $this->t('Pagination speed.'),
      '#default_value' => $entity->getDotsspeed(),
      '#required' => FALSE,
    );
    $form['dragendspeed'] = array(
      '#type' => 'number',
      '#title' => $this->t('dragEndSpeed'),
      '#description' => $this->t('Drag end speed.'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    );
    $form['callbacks'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('callbacks'),
      '#description' => $this->t('Enable callback events.'),
      '#default_value' => $entity->getCallbacks(),
      '#required' => FALSE,
    );
    $form['responsive'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Responsive'),
      '#description' => $this->t('Object containing responsive options. Can be set to false to remove responsive capabilities.'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    );
    $form['responsiverefreshrate'] = array(
      '#type' => 'number',
      '#title' => $this->t('responsiveRefreshRate'),
      '#description' => $this->t('Responsive refresh rate.'),
      '#default_value' => $entity->getResponsiverefreshrate(),
      '#required' => FALSE,
    );
    $form['responsivebaseelement'] = array(
      '#type' => 'number',
      '#title' => $this->t('responsiveBaseElement'),
      '#description' => $this->t('Set on any DOM element. If you care about non responsive browser (like ie8) then use it on main wrapper. This will prevent from crazy resizing.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    );
    $form['responsiveclass'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('responsiveClass'),
      '#description' => $this->t('Optional helper class. Add "owl-reponsive-" + "breakpoint" class to main element. Can be used to stylize content on given breakpoint'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    );
    $form['video'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Video'),
      '#description' => $this->t('Enable fetching YouTube/Vimeo videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    );
    $form['videoheight'] = array(
      '#type' => 'number',
      '#title' => $this->t('videoHeight'),
      '#description' => $this->t('Set height for videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    );
    $form['videowidth'] = array(
      '#type' => 'number',
      '#title' => $this->t('videoWidth'),
      '#description' => $this->t('Set width for videos.'),
      '#default_value' => $entity->getResponsivebaseelement(),
      '#required' => FALSE,
    );
    $form['animateout'] = array(
      '#type' => 'string',
      '#title' => $this->t('animateOut'),
      '#description' => $this->t('CSS3 animation out.'),
      '#default_value' => $entity->getAnimateout(),
      '#required' => FALSE,
    );
    $form['animatein'] = array(
      '#type' => 'string',
      '#title' => $this->t('animateIn'),
      '#description' => $this->t('CSS3 animation in.'),
      '#default_value' => $entity->getAnimatein(),
      '#required' => FALSE,
    );
    $form['fallbackeasing'] = array(
      '#type' => 'string',
      '#title' => $this->t('fallbackEasing'),
      '#description' => $this->t('Easing for CSS2 $.animate.'),
      '#default_value' => $entity->getFallbackeasing(),
      '#required' => FALSE,
    );
    $form['info'] = array(
      '#type' => 'string',
      '#title' => $this->t('info'),
      '#description' => $this->t('Callback to retrieve basic information (current item/pages/widths). Info function second parameter is Owl DOM object reference.'),
      '#default_value' => $entity->getInfo(),
      '#required' => FALSE,
    );
    $form['nesteditemelement'] = array(
      '#type' => 'string',
      '#title' => $this->t('nestedItemElement'),
      '#description' => $this->t('Use it if owl items are deep nasted inside some generated content. E.g "youritem". Dont use dot before class name.'),
      '#default_value' => $entity->getNesteditemselector(),
      '#required' => FALSE,
    );
    $form['itemelement'] = array(
      '#type' => 'string',
      '#title' => $this->t('itemElement'),
      '#description' => $this->t('DOM element type for owl-item.'),
      '#default_value' => $entity->getItemelement(),
      '#required' => FALSE,
    );
    $form['stageelement'] = array(
      '#type' => 'string',
      '#title' => $this->t('stageElement'),
      '#description' => $this->t('DOM element type for owl-stage.'),
      '#default_value' => $entity->getStageelement(),
      '#required' => FALSE,
    );
    $form['navcontainer'] = array(
      '#type' => 'string',
      '#title' => $this->t('navContainer'),
      '#description' => $this->t('Set your own container for nav.'),
      '#default_value' => $entity->getNavcontainer(),
      '#required' => FALSE,
    );
    $form['dotscontainer'] = array(
      '#type' => 'string',
      '#title' => $this->t('dotsContainer'),
      '#description' => $this->t('Set your own container for nav.'),
      '#default_value' => $entity->getDotscontainer(),
      '#required' => FALSE,
    );

    /* theme settings */

    $form['themeclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('themeClass'),
      '#description' => $this->t('Theme class.'),
      '#default_value' => $entity->getThemeclass()?:'owl-theme',
      '#required' => FALSE,
    );
    $form['baseclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('baseClass'),
      '#description' => $this->t('Base element class.'),
      '#default_value' => $entity->getBaseclass()?:'owl-carousel',
      '#required' => FALSE,
    );
    $form['itemclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('itemClass'),
      '#description' => $this->t('Item class.'),
      '#default_value' => $entity->getItemclass()?:'owl-item',
      '#required' => FALSE,
    );
    $form['centerclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('centerClass'),
      '#description' => $this->t('Center class.'),
      '#default_value' => $entity->getCenterclass()?:'center',
      '#required' => FALSE,
    );
    $form['activeclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('activeClass'),
      '#description' => $this->t('Active class.'),
      '#default_value' => $entity->getActiveclass()?:'active',
      '#required' => FALSE,
    );
    $form['navcontainerclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('navContainerClass'),
      '#description' => $this->t('Nav container class.'),
      '#default_value' => $entity->getNavcontainerclass()?:'owl-nav',
      '#required' => FALSE,
    );
    $form['navclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('navClass'),
      '#description' => $this->t('Nav buttons class.'),
      '#default_value' => $entity->getNavclass()?:'[&#x27;owl-prev&#x27;,&#x27;owl-next&#x27;]',
      '#required' => FALSE,
    );
    $form['controlsclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('controlsClass'),
      '#description' => $this->t('Controls Class - wrapper for navs and dots.'),
      '#default_value' => $entity->getControlsclass()?:'owl-controls',
      '#required' => FALSE,
    );
    $form['dotclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('dotClass'),
      '#description' => $this->t('Dot Class'),
      '#default_value' => $entity->getDotclass()?:'owl-dot',
      '#required' => FALSE,
    );
    $form['dotsclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('dotsClass'),
      '#description' => $this->t('Dots Class - Container for dots.'),
      '#default_value' => $entity->getDotsclass()?:'owl-dots',
      '#required' => FALSE,
    );
    $form['autoheightclass'] = array(
      '#type' => 'string',
      '#title' => $this->t('autoheightclass'),
      '#description' => $this->t('Auto height Class.'),
      '#default_value' => $entity->getAutoheightclass()?:'owl-height',
      '#required' => FALSE,
    );

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
