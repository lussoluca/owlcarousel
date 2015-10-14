<?php

/**
 * @file
 * Contains \Drupal\owlcarousel\Plugin\Field\FieldFormatter\OwlCarouselDefaultFormatter.
 */

namespace Drupal\owlcarousel\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Link;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\image\Plugin\Field\FieldType\ImageItem;
use Drupal\owlcarousel\OwlCarouselManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Cache\Cache;

/**
 * Plugin implementation of the 'owlcarousel' formatter.
 *
 * @FieldFormatter(
 *   id = "owlcarousel_default",
 *   label = @Translation("Owl carousel default"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class OwlCarouselDefaultFormatter extends OwlCarouselFormatterBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\owlcarousel\OwlCarouselManager
   */
  protected $owlCarouselManager;

  /**
   * The Owl carousel style entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $owlCarouselStyleStorage;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * Constructs an ImageFormatter object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings settings.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user.
   * @param \Drupal\owlcarousel\OwlCarouselManager $owl_carousel_manager
   * @param \Drupal\Core\Entity\EntityStorageInterface $owl_carousel_style_storage
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, AccountInterface $current_user, OwlCarouselManager $owl_carousel_manager, EntityStorageInterface $owl_carousel_style_storage) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->owlCarouselManager = $owl_carousel_manager;
    $this->owlCarouselStyleStorage = $owl_carousel_style_storage;
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('current_user'),
      $container->get('owlcarousel.manager'),
      $container->get('entity.manager')->getStorage('owl_carousel_style')
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'image_style' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form = parent::settingsForm($form, $form_state);

    $image_styles = $this->owlCarouselManager->owlCarouselStyleOptions(FALSE);
    $owl_description_link = Link::fromTextAndUrl(
      $this->t('Configure Owl Carousel Styles'),
      Url::fromRoute('entity.owl_carousel_style.collection')
    );
    $form['owl_carousel_style'] = [
      '#title' => t('Owl carousel style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('owl_carousel_style'),
      '#options' => $image_styles,
      '#description' => $owl_description_link->toRenderable() + [
          '#access' => $this->currentUser->hasPermission('administer owl carousel styles')
        ],
    ];

    if ('image' === $this->fieldDefinition->getType()) {
      $image_styles = image_style_options(FALSE);
      $image_description_link = Link::fromTextAndUrl(
        $this->t('Configure Image Styles'),
        Url::fromRoute('entity.image_style.collection')
      );
      $form['image_style'] = [
        '#title' => t('Image style'),
        '#type' => 'select',
        '#default_value' => $this->getSetting('image_style'),
        '#empty_option' => t('None (original image)'),
        '#options' => $image_styles,
        '#description' => $image_description_link->toRenderable() + [
            '#access' => $this->currentUser->hasPermission('administer image styles')
          ],
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();

//    $display = $instance['display'][$view_mode];
//    $settings = $display['settings'];
//
//    $message = '@settings applied to carousel instance.';
//    if ($field['type'] == 'image') {
//      $message = '@settings with image style @style applied to carousel instance.';
//    }
//
//    $summary = t($message, array(
//      '@settings' => $settings['settings_group'],
//      '@style' => $settings['image_style'],
//    ));

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    $items_group = FALSE;

    if ('image' === $this->fieldDefinition->getType()) {
      /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem $item */
      foreach ($items as $item) {
        $vars = array(
//          'path' => $item->get('path'),
//          'width' => $item->get('width'),
//          'height' => $item->get('height'),
//          'alt' => $item->get('alt'),
//          'title' => $item->get('title'),
        );

        if (empty($settings['image_style'])) {
          $items_group[]['row'] = [
              '#theme' => 'image'
            ] + $vars;
        }
        else {
          $vars += array('style_name' => $settings['image_style']);
          $items_group[]['row'] = [
              '#theme' => 'image_style'
            ] + $vars;
        }
      }
    }

    $elements[] = [
      '#theme' => 'owlcarousel_wrapper',
      '#items' => $items_group,
      '#preset' => $this->getSetting('owl_carousel_style'),
      '#attached' => [
        'library' => [
          'owlcarousel/owlcarousel',
        ]
      ]
    ];

    return $elements;
  }
}
