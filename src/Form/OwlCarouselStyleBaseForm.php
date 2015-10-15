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

    $form['owlsettings'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    /* general vertical tab */
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
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Items'),
      '#description' => $this->t('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width'),
      '#default_value' => $entity->getItems(),
      '#required' => TRUE,
      '#prefix' => '<div class="1/2">',
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

    /* responsive vertival tab */
    $form['responsive'] = [
      '#type' => 'details',
      '#title' => t('Responsive settings'),
      '#group' => 'owlsettings',
    ];

    $form['responsive']['responsive'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable OwlCarousel responsive behaviour'),
      '#description' => $this->t('Can be left unchecked to remove responsive capabilities. <a href="http://www.owlcarousel.owlgraphic.com/demos/responsive.html">Demo</a>'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];

    $form['responsive']['responsiveitems'] = [
      '#type' => 'fieldset',
      '#title' => t('Responsive items settings'),
      '#states' => array(
        // Only show this field when the 'responsive' checkbox is enabled.
        'visible' => array(
          ':input[name="responsive"]' => array('checked' => TRUE),
        ),
      ),
    ];

    $form['responsive']['responsiveitems']['mqone'] = [
      '#markup' => '<h3>Mobile</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsiveitems']['responsivequeryone'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Mobile media query min-width.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsivequeryone(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['responsiveitemone'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Number of visible items for mobile media query.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsiveitemone(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['mqtwo'] = [
      '#markup' => '<h3>Tablet portrait</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsiveitems']['responsivequerytwo'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Tablet portrait media query min-width.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsivequerytwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['responsiveitemtwo'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Number of visible items for tablet portrait media query.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsiveitemtwo(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['mqthree'] = [
      '#markup' => '<h3>Tablet landscape</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsiveitems']['responsivequerythree'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Tablet landscape media query min-width.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsivequerythree(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['responsiveitemthree'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Number of visible items for tablet landscape media query.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsiveitemthree(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['mqfour'] = [
      '#markup' => '<h3>Desktop</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsiveitems']['responsivequeryfour'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Desktop media query min-width.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsivequeryfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['responsiveitemfour'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Number of visible items for desktop media query.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsiveitemfour(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['mqfive'] = [
      '#markup' => '<h3>Desktop large</h3><p>This allows you to preset the number of slides visible with a particular browser width.</p>',
    ];
    $form['responsive']['responsiveitems']['responsivequeryfive'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Large desktop media query min-width.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsivequeryfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsiveitems']['responsiveitemfive'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => t('Number of visible items for large desktop media query.'),
      '#description' => $this->t('Positive number.'),
      '#default_value' => $entity->getResponsiveitemfive(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];

    $form['responsive']['responsivebehve'] = [
      '#type' => 'fieldset',
      '#title' => t('Responsive behaviours'),
      '#states' => array(
        // Only show this field when the 'responsive' checkbox is enabled.
        'visible' => array(
          ':input[name="responsive"]' => array('checked' => TRUE),
        ),
      ),
    ];
    $form['responsive']['responsivebehve']['responsiverefreshrate'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Responsive refresh rate.'),
      '#description' => $this->t('Milliseconds. E.g. 200 = 0.2s'),
      '#default_value' => $entity->getResponsiverefreshrate() ?: 200,
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsivebehve']['responsivebaseelement'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Responsive base element. Set on any DOM element.'),
      '#description' => $this->t('If you care about non responsive browser (like ie8) then use it on main wrapper. This will prevent from crazy resizing.'),
      '#default_value' => $entity->getResponsivebaseelement() ?: 'window',
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['responsive']['responsivebehve']['responsiveclass'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable optional helper class. '),
      '#description' => $this->t('Add "owl-reponsive-" + "breakpoint" class to main element. Can be used to stylize content on given breakpoint'),
      '#default_value' => $entity->getResponsiveclass() ?: FALSE,
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];

    // defined once - they will still this way all along

    $responsive_tab_1 = $entity->getResponsivequeryone() ? '' : 'js-disabled is--disabled';
    $responsive_tab_2 = $entity->getResponsivequerytwo() ? '' : 'js-disabled is--disabled';
    $responsive_tab_3 = $entity->getResponsivequerythree() ? '' : 'js-disabled is--disabled';
    $responsive_tab_4 = $entity->getResponsivequeryfour() ? '' : 'js-disabled is--disabled';
    $responsive_tab_5 = $entity->getResponsivequeryfive() ? '' : 'js-disabled is--disabled';

    /* theme settings */
    $form['theme'] = [
      '#type' => 'details',
      '#title' => t('Theme settings'),
      '#group' => 'owlsettings',
    ];

    $form['theme']['tabs_theme'] = [
      '#markup' => '<ul class="settings__tabs js-tabs">' .
          '<li class="settings__tab is--active">' .
            '<span class="settings__link js-link" data-target="general--theme">' . t('General') . '</span>' .
          '</li>' .
          '<li class="settings__tab">' .
            '<span class="settings__link js-link ' . $responsive_tab_1 . '" data-target="mob--theme">' . t('Mobile') . '</span>' .
          '</li>' .
          '<li class="settings__tab">' .
            '<span class="settings__link js-link ' . $responsive_tab_2 . '" data-target="tabp--theme">' . t('Tablet portrait') . '</span>' .
          '</li>' .
          '<li class="settings__tab">' .
            '<span class="settings__link js-link ' . $responsive_tab_3 . '" data-target="tabl--theme">' . t('Tablet landscape') . '</span>' .
          '</li>' .
          '<li class="settings__tab">' .
            '<span class="settings__link js-link ' . $responsive_tab_4 . '" data-target="des--theme">' . t('Desktop') . '</span>' .
          '</li>' .
          '<li class="settings__tab">' .
            '<span class="settings__link js-link ' . $responsive_tab_5 . '" data-target="dasl--theme">' . t('Desktop Large') . '</span>' .
          '</li>' .
        '</ul>' .
        '<div class="settings__contentainer clearfix">',
    ];

    $form['theme']['tabs_theme__general'] = [
      '#prefix' => '<div class="settings__content clearfix is--active" data-target="general--theme">',
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
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Item margin'),
      '#description' => $this->t('margin-right(px) on item.'),
      '#default_value' => $entity->getMargin() ?: 0,
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];
    $form['theme']['stagpadding'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Stage padding'),
      '#description' => $this->t('Padding left and right on stage (can see neighbours). <a href="http://www.owlcarousel.owlgraphic.com/demos/stagepadding.html">Demo</a>'),
      '#default_value' => $entity->getStagepadding() ?: 0,
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
    ];

    $form['theme']['tabs_theme__mob'] = [
      '#markup' => '</div><div class="settings__content clearfix" data-target="mob--theme">',
    ];

    $form['theme']['tabs_theme__tabp'] = [
      '#markup' => '</div><div class="settings__content clearfix" data-target="tabp--theme">',
    ];

    $form['theme']['tabs_theme__tabl'] = [
      '#markup' => '</div><div class="settings__content clearfix" data-target="tabl--theme">',
    ];

    $form['theme']['tabs_theme__des'] = [
      '#markup' => '</div><div class="settings__content clearfix" data-target="des--theme">',
    ];

    $form['theme']['tabs_theme__desl'] = [
      '#markup' => '</div><div class="settings__content" data-target="desl--theme">',
    ];

    $form['theme']['tabs_theme__end'] = [
      '#markup' => '</div></div>',
    ];

    /* Animations */
    $form['css3animations'] = [
      '#type' => 'details',
      '#title' => t('Animation settings'),
      '#group' => 'owlsettings',
    ];

    $form['css3animations']['animateinfo'] = [
      '#markup' => '<p><b>Animate functions work only with one item and only in browsers that support perspective property.</b></p>',
    ];

    $form['css3animations']['animatelib'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable <a href="http://daneden.github.io/animate.css/">animate.css</a>. <a href="http://www.owlcarousel.owlgraphic.com/demos/animate.html">Demo</a> '),
      '#description' => $this->t('Include the animate.css library to allow the use of premade animation CSS classes.'),
      '#default_value' => $entity->getAnimatelib(),
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['css3animations']['animatein'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CSS3 animation in.'),
      '#description' => $this->t('Class name for the "IN" animation.'),
      '#default_value' => $entity->getAnimatein(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'responsive' checkbox is enabled.
        'visible' => [
          ':input[name="animatelib"]' => ['checked' => FALSE],
        ],
        'invisible' => [
          ':input[name="animatelib"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['css3animations']['animateout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CSS3 animation out.'),
      '#default_value' => $entity->getAnimateout(),
      '#description' => $this->t('Class name for the "OUT" animation.'),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'responsive' checkbox is enabled.
        'visible' => [
          ':input[name="animatelib"]' => ['checked' => FALSE],
        ],
        'invisible' => [
          ':input[name="animatelib"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['css3animations']['animateinlib'] = [
      '#type' => 'select',
      '#title' => $this->t('Animate.css class name for the "IN" animation.'),
      '#description' => $this->t('Select a class.'),
      '#default_value' => $entity->getAnimateinlib(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'responsive' checkbox is enabled.
        'visible' => [
          ':input[name="animatelib"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="animatelib"]' => ['checked' => FALSE],
        ],
      ],
      '#options' => [
        "bounce" => "bounce",
        "flash" => "flash",
        "pulse" => "pulse",
        "rubberBand" => "rubberBand",
        "shake" => "shake",
        "swing" => "swing",
        "tada" => "tada",
        "wobble" => "wobble",
        "jello" => "jello",
        "bounceIn" => "bounceIn",
        "bounceInDown" => "bounceInDown",
        "bounceInLeft" => "bounceInLeft",
        "bounceInRight" => "bounceInRight",
        "bounceInUp" => "bounceInUp",
        "bounceOut" => "bounceOut",
        "bounceOutDown" => "bounceOutDown",
        "bounceOutLeft" => "bounceOutLeft",
        "bounceOutRight" => "bounceOutRight",
        "bounceOutUp" => "bounceOutUp",
        "fadeIn" => "fadeIn",
        "fadeInDown" => "fadeInDown",
        "fadeInDownBig" => "fadeInDownBig",
        "fadeInLeft" => "fadeInLeft",
        "fadeInLeftBig" => "fadeInLeftBig",
        "fadeInRight" => "fadeInRight",
        "fadeInRightBig" => "fadeInRightBig",
        "fadeInUp" => "fadeInUp",
        "fadeInUpBig" => "fadeInUpBig",
        "fadeOut" => "fadeOut",
        "fadeOutDown" => "fadeOutDown",
        "fadeOutDownBig" => "fadeOutDownBig",
        "fadeOutLeft" => "fadeOutLeft",
        "fadeOutLeftBig" => "fadeOutLeftBig",
        "fadeOutRight" => "fadeOutRight",
        "fadeOutRightBig" => "fadeOutRightBig",
        "fadeOutUp" => "fadeOutUp",
        "fadeOutUpBig" => "fadeOutUpBig",
        "flip" => "flip",
        "flipInX" => "flipInX",
        "flipInY" => "flipInY",
        "flipOutX" => "flipOutX",
        "flipOutY" => "flipOutY",
        "lightSpeedIn" => "lightSpeedIn",
        "lightSpeedOut" => "lightSpeedOut",
        "rotateIn" => "rotateIn",
        "rotateInDownLeft" => "rotateInDownLeft",
        "rotateInDownRight" => "rotateInDownRight",
        "rotateInUpLeft" => "rotateInUpLeft",
        "rotateInUpRight" => "rotateInUpRight",
        "rotateOut" => "rotateOut",
        "rotateOutDownLeft" => "rotateOutDownLeft",
        "rotateOutDownRight" => "rotateOutDownRight",
        "rotateOutUpLeft" => "rotateOutUpLeft",
        "rotateOutUpRight" => "rotateOutUpRight",
        "slideInUp" => "slideInUp",
        "slideInDown" => "slideInDown",
        "slideInLeft" => "slideInLeft",
        "slideInRight" => "slideInRight",
        "slideOutUp" => "slideOutUp",
        "slideOutDown" => "slideOutDown",
        "slideOutLeft" => "slideOutLeft",
        "slideOutRight" => "slideOutRight",
        "zoomIn" => "zoomIn",
        "zoomInDown" => "zoomInDown",
        "zoomInLeft" => "zoomInLeft",
        "zoomInRight" => "zoomInRight",
        "zoomInUp" => "zoomInUp",
        "zoomOut" => "zoomOut",
        "zoomOutDown" => "zoomOutDown",
        "zoomOutLeft" => "zoomOutLeft",
        "zoomOutRight" => "zoomOutRight",
        "zoomOutUp" => "zoomOutUp",
        "hinge" => "hinge",
        "rollIn" => "rollIn",
        "rollOut" => "rollOut"
      ],
    ];
    $form['css3animations']['animateoutlib'] = [
      '#type' => 'select',
      '#title' => $this->t('Animate.css class name for the "OUT" animation.'),
      '#default_value' => $entity->getAnimateoutlib(),
      '#description' => $this->t('Select a class.'),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'animatelib' checkbox is enabled.
        'visible' => [
          ':input[name="animatelib"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="animatelib"]' => ['checked' => FALSE],
        ],
      ],
      '#options' => [
        "bounce" => "bounce",
        "flash" => "flash",
        "pulse" => "pulse",
        "rubberBand" => "rubberBand",
        "shake" => "shake",
        "swing" => "swing",
        "tada" => "tada",
        "wobble" => "wobble",
        "jello" => "jello",
        "bounceIn" => "bounceIn",
        "bounceInDown" => "bounceInDown",
        "bounceInLeft" => "bounceInLeft",
        "bounceInRight" => "bounceInRight",
        "bounceInUp" => "bounceInUp",
        "bounceOut" => "bounceOut",
        "bounceOutDown" => "bounceOutDown",
        "bounceOutLeft" => "bounceOutLeft",
        "bounceOutRight" => "bounceOutRight",
        "bounceOutUp" => "bounceOutUp",
        "fadeIn" => "fadeIn",
        "fadeInDown" => "fadeInDown",
        "fadeInDownBig" => "fadeInDownBig",
        "fadeInLeft" => "fadeInLeft",
        "fadeInLeftBig" => "fadeInLeftBig",
        "fadeInRight" => "fadeInRight",
        "fadeInRightBig" => "fadeInRightBig",
        "fadeInUp" => "fadeInUp",
        "fadeInUpBig" => "fadeInUpBig",
        "fadeOut" => "fadeOut",
        "fadeOutDown" => "fadeOutDown",
        "fadeOutDownBig" => "fadeOutDownBig",
        "fadeOutLeft" => "fadeOutLeft",
        "fadeOutLeftBig" => "fadeOutLeftBig",
        "fadeOutRight" => "fadeOutRight",
        "fadeOutRightBig" => "fadeOutRightBig",
        "fadeOutUp" => "fadeOutUp",
        "fadeOutUpBig" => "fadeOutUpBig",
        "flip" => "flip",
        "flipInX" => "flipInX",
        "flipInY" => "flipInY",
        "flipOutX" => "flipOutX",
        "flipOutY" => "flipOutY",
        "lightSpeedIn" => "lightSpeedIn",
        "lightSpeedOut" => "lightSpeedOut",
        "rotateIn" => "rotateIn",
        "rotateInDownLeft" => "rotateInDownLeft",
        "rotateInDownRight" => "rotateInDownRight",
        "rotateInUpLeft" => "rotateInUpLeft",
        "rotateInUpRight" => "rotateInUpRight",
        "rotateOut" => "rotateOut",
        "rotateOutDownLeft" => "rotateOutDownLeft",
        "rotateOutDownRight" => "rotateOutDownRight",
        "rotateOutUpLeft" => "rotateOutUpLeft",
        "rotateOutUpRight" => "rotateOutUpRight",
        "slideInUp" => "slideInUp",
        "slideInDown" => "slideInDown",
        "slideInLeft" => "slideInLeft",
        "slideInRight" => "slideInRight",
        "slideOutUp" => "slideOutUp",
        "slideOutDown" => "slideOutDown",
        "slideOutLeft" => "slideOutLeft",
        "slideOutRight" => "slideOutRight",
        "zoomIn" => "zoomIn",
        "zoomInDown" => "zoomInDown",
        "zoomInLeft" => "zoomInLeft",
        "zoomInRight" => "zoomInRight",
        "zoomInUp" => "zoomInUp",
        "zoomOut" => "zoomOut",
        "zoomOutDown" => "zoomOutDown",
        "zoomOutLeft" => "zoomOutLeft",
        "zoomOutRight" => "zoomOutRight",
        "zoomOutUp" => "zoomOutUp",
        "hinge" => "hinge",
        "rollIn" => "rollIn",
        "rollOut" => "rollOut"
      ],
    ];
    $form['css3animations']['fallbackeasing'] = [
      '#type' => 'select',
      '#title' => $this->t('Easing for CSS2 $.animate.'),
      '#description' => $this->t('Select an easing function for easing. <a href="http://gsgd.co.uk/sandbox/jquery/easing/">Demo.</a>'),
      '#default_value' => $entity->getFallbackeasing(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#options' => [
        "" => t('Select an Easing method'),
        "jswing" => "jswing",
        "def" => "def",
        "easeInQuad" => "easeInQuad",
        "easeOutQuad" => "easeOutQuad",
        "easeInOutQuad" => "easeInOutQuad",
        "easeInCubic" => "easeInCubic",
        "easeOutCubic" => "easeOutCubic",
        "easeInOutCubic" => "easeInOutCubic",
        "easeInQuart" => "easeInQuart",
        "easeOutQuart" => "easeOutQuart",
        "easeInOutQuart" => "easeInOutQuart",
        "easeInQuint" => "easeInQuint",
        "easeOutQuint" => "easeOutQuint",
        "easeInOutQuint" => "easeInOutQuint",
        "easeInSine" => "easeInSine",
        "easeOutSine" => "easeOutSine",
        "easeInOutSine" => "easeInOutSine",
        "easeInExpo" => "easeInExpo",
        "easeOutExpo" => "easeOutExpo",
        "easeInOutExpo" => "easeInOutExpo",
        "easeInCirc" => "easeInCirc",
        "easeOutCirc" => "easeOutCirc",
        "easeInOutCirc" => "easeInOutCirc",
        "easeInElastic" => "easeInElastic",
        "easeOutElastic" => "easeOutElastic",
        "easeInOutElastic" => "easeInOutElastic",
        "easeInBack" => "easeInBack",
        "easeOutBack" => "easeOutBack",
        "easeInOutBack" => "easeInOutBack",
        "easeInBounce" => "easeInBounce",
        "easeOutBounce" => "easeOutBounce",
        "easeInOutBounce" => "easeInOutBounce",
      ],
    ];

    /* css settings and fallbacks */
    $form['navigation'] = [
      '#type' => 'details',
      '#title' => t('Navigation settings'),
      '#group' => 'owlsettings',
    ];
    $form['navigation']['arrownavigation'] = [
      '#type' => 'fieldset',
      '#title' => t('Arrow navigation settings'),
    ];

    $form['navigation']['arrownavigation']['nav'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Navigation, showing next/prev buttons.'),
      '#default_value' => $entity->getNav() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['navigation']['arrownavigation']['navrewind'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable "first" and "last" links'),
      '#default_value' => $entity->getNavrewind() ?: FALSE,
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="nav"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="nav"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['arrownavigation']['navtextprev'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for "previous" navigation element'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextprev() ?: 'prev',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="nav"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="nav"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['arrownavigation']['navtextnext'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for "next" navigation element'),
      '#description' => $this->t('HTML allowed.'),
      '#default_value' => $entity->getNavtextnext() ?: 'prev',
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="nav"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="nav"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['arrownavigation']['slideby'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Elements to slide with navigation'),
      '#description' => $this->t('Navigation slide by x. "page" textfield can be set to slide by page.'),
      '#default_value' => $entity->getSlideby() ?: 'page',
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="nav"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="nav"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['dotsnavigation'] = [
      '#type' => 'fieldset',
      '#title' => t('Dots navigation settings'),
    ];
    $form['navigation']['dotsnavigation']['dots'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Dots navigation'),
      '#default_value' => $entity->getDots() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['navigation']['dotsnavigation']['dotseach'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Elements for Dot'),
      '#description' => $this->t('Show dots each x item.'),
      '#default_value' => $entity->getDotseach() ?: 1,
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="dots"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="dots"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['dotsnavigation']['dotdata'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable data-dot content'),
      '#description' => $this->t('Used by data-dot content.'),
      '#default_value' => $entity->getDotdata() ?: FALSE,
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'nav' checkbox is enabled.
        'visible' => [
          ':input[name="dots"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="dots"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['navigation']['startposition'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Slider start position'),
      '#description' => $this->t('Start position (number) or URL Hash textfield like "#id".'),
      '#default_value' => $entity->getStartposition() ?: 0,
      '#required' => FALSE,
    ];

    $form['interactions'] = [
      '#type' => 'details',
      '#title' => t('Interactions'),
      '#group' => 'owlsettings',
    ];

    /* autoplay */
    $form['interactions']['autoplay'] = [
      '#type' => 'fieldset',
      '#title' => t('Autoplay options'),
    ];
    $form['interactions']['autoplay']['autoplay'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoplay'),
      '#description' => $this->t('<a href="http://www.owlcarousel.owlgraphic.com/demos/autoplay.html">Demo.</a>'),
      '#default_value' => $entity->getAutoplay() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['autoplay']['autoplayhoverpause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Pause on mouse hover.'),
      '#default_value' => $entity->getAutoplayhoverpause() ?: FALSE,
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'autoplay' checkbox is enabled.
        'visible' => [
          ':input[name="autoplay"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="autoplay"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['interactions']['autoplay']['autoplayspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Autoplay speed.'),
      '#description' => $this->t('Milliseconds. E.g. 5000 = 5s'),
      '#default_value' => $entity->getAutoplayspeed() ?: '5000',
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'autoplay' checkbox is enabled.
        'visible' => [
          ':input[name="autoplay"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="autoplay"]' => ['checked' => FALSE],
        ],
      ],
    ];
    $form['interactions']['autoplay']['autoplaytimeout'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Autoplay interval timeout.'),
      '#description' => $this->t('Milliseconds. E.g. 5000 = 5s'),
      '#default_value' => $entity->getAutoplaytimeout() ?: '0',
      '#required' => FALSE,
      '#states' => [
        // Only show this field when the 'autoplay' checkbox is enabled.
        'visible' => [
          ':input[name="autoplay"]' => ['checked' => TRUE],
        ],
        'invisible' => [
          ':input[name="autoplay"]' => ['checked' => FALSE],
        ],
      ],
    ];

    /* Interactions */
    $form['interactions']['interactions'] = [
      '#type' => 'fieldset',
      '#title' => t('Drag settings'),
    ];
    $form['interactions']['interactions']['mousedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Mouse drag'),
      '#description' => $this->t('Allow users to drag item with mouse drag.'),
      '#default_value' => $entity->getMousedrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['interactions']['touchdrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Touch drag'),
      '#description' => $this->t('Allow users to drag item with touch drag.'),
      '#default_value' => $entity->getTouchdrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['interactions']['pulldrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable stage pull'),
      '#description' => $this->t('Stage pull to the edge.'),
      '#default_value' => $entity->getPulldrag() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['interactions']['freedrag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable free drag'),
      '#description' => $this->t('Allow drag interaction to ignore item boundaries'),
      '#default_value' => $entity->getFreedrag() ?: FALSE,
      '#required' => FALSE,
    ];

    /* behaviour*/
    $form['interactions']['behaviour'] = [
      '#type' => 'fieldset',
      '#title' => t('Items behaviour'),
    ];
    $form['interactions']['behaviour']['loop'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Infinity Loop'),
      '#description' => $this->t('Duplicate last and first items to get loop illusion.'),
      '#default_value' => $entity->getLoop() ?: TRUE,
      '#required' => FALSE,
    ];
    $form['interactions']['behaviour']['center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Center items'),
      '#description' => $this->t('Works well with even an odd number of items. <a href="http://www.owlcarousel.owlgraphic.com/demos/center.html">Demo</a>'),
      '#default_value' => $entity->getCenter() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['behaviour']['merge'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Merge Items'),
      '#description' => $this->t('Looking for data-merge="{number}" inside item. <a href="http://www.owlcarousel.owlgraphic.com/demos/merge.html">Demo</a>'),
      '#default_value' => $entity->getMerge() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['behaviour']['mergefit'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Fit merged items'),
      '#description' => $this->t('If screen is smaller than items value owlCarousel will merge multiple items'),
      '#default_value' => $entity->getMergefit() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['behaviour']['autowidth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Autowidth'),
      '#description' => $this->t('Set non grid content. Try using width style on divs. <a href="http://www.owlcarousel.owlgraphic.com/demos/autowidth.html">Demo</a>'),
      '#default_value' => $entity->getAutowidth() ?: FALSE,
      '#required' => FALSE,
    ];
    $form['interactions']['behaviour']['rtl'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Rtl'),
      '#description' => $this->t('Change direction from Right to left <a href="http://www.owlcarousel.owlgraphic.com/demos/rtl.html">Demo</a>'),
      '#default_value' => $entity->getAutowidth() ?: FALSE,
      '#required' => FALSE,
    ];

    /* speed */
    $form['interactions']['speed'] = [
      '#type' => 'fieldset',
      '#title' => t('Speed settings'),
    ];
    $form['interactions']['speed']['smartspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Autoplay speed'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getSmartspeed(),
      '#required' => FALSE,
    ];
    $form['interactions']['speed']['fluidspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Use fluid speed function'),
      '#description' => $this->t('Speed Calculate. More info to come.'),
      '#default_value' => $entity->getFluidspeed(),
      '#required' => FALSE,
    ];
    $form['interactions']['speed']['navspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Arrow navigation speed'),
      '#description' => $this->t('Speed to change from one item or page to the next, when using arrow navigation. Milliseconds. e.g. 5000 = 5s'),
      '#default_value' => $entity->getNavspeed(),
      '#required' => FALSE,
    ];
    $form['interactions']['speed']['dotsspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Dot navigation speed'),
      '#description' => $this->t('Speed to change from one item or page to the next, when using dot navigation. Milliseconds. e.g. 5000 = 5s'),
      '#default_value' => $entity->getDotsspeed(),
      '#required' => FALSE,
    ];
    $form['interactions']['speed']['dragendspeed'] = [
      '#type' => 'number',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Drag end speed'),
      '#description' => $this->t('Time to end the drag animation. Milliseconds. e.g. 5000 = 5s'),
      '#default_value' => $entity->getDragendspeed(),
      '#required' => FALSE,
    ];


    $form['plugins'] = [
      '#type' => 'details',
      '#title' => t('Plugins'),
      '#group' => 'owlsettings',
    ];
    /* video plugin */
    $form['plugins']['video'] = [
      '#type' => 'fieldset',
      '#title' => t('Video plugin settings'),
    ];
    $form['plugins']['video']['video'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable fetching YouTube/Vimeo videos.'),
      '#description' => $this->t('<a href="http://www.owlcarousel.owlgraphic.com/demos/video.html">Demo.</a>'),
      '#default_value' => $entity->getVideo(),
      '#required' => FALSE,
      '#prefix' => '<div class="2/2">',
      '#suffix' => '</div>',
    ];
    $form['plugins']['video']['videoheight'] = [
      '#type' => 'textfield',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Set height for videos'),
      '#description' => $this->t('Positive number or empty.'),
      '#default_value' => $entity->getVideoheight(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'autoplay' checkbox is enabled.
        'visible' => [
          ':input[name="video"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['plugins']['video']['videowidth'] = [
      '#type' => 'textfield',
      '#attributes' => ['min' => "0"],
      '#title' => $this->t('Set width for videos'),
      '#description' => $this->t('Positive number or empty'),
      '#default_value' => $entity->getVideowidth(),
      '#required' => FALSE,
      '#prefix' => '<div class="1/2">',
      '#suffix' => '</div>',
      '#states' => [
        // Only show this field when the 'autoplay' checkbox is enabled.
        'visible' => [
          ':input[name="video"]' => ['checked' => TRUE],
        ],
      ],
    ];

    /* autoheight plugin */
    $form['plugins']['autoheight'] = [
      '#type' => 'fieldset',
      '#title' => t('Autoheight plugin settings'),
      '#description' => $this->t('Autoheight Plugin works only with 1 item on screen.'),
    ];

    $form['plugins']['autoheight']['autoheight'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autoheight plugin'),
      '#description' => $this->t('<a href="http://www.owlcarousel.owlgraphic.com/demos/autoheight.html">Demo.</a> '),
      '#default_value' => $entity->getAutoheight(),
      '#required' => FALSE,
    ];

    /* lazyLoad plugin */
    $form['plugins']['lazyload'] = [
      '#type' => 'fieldset',
      '#title' => t('LazyLoad plugin settings'),
    ];

    $form['plugins']['lazyload']['lazyload'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable images lazy loading'),
      '#description' => $this->t('Use data-src and data-src-retina for highres. Also load images into background inline style if element is not <img>. <a href="http://www.owlcarousel.owlgraphic.com/demos/lazyLoad.html">Demo.</a> '),
      '#default_value' => $entity->getLazyload(),
      '#required' => FALSE,
    ];
    $form['plugins']['lazyload']['lazycontent'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable content lazy loading'),
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
      '#title' => $this->t('Info'),
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
