<?php

/**
 * @file
 * Contains \Drupal\views\Plugin\views\style\DefaultStyle.
 */

namespace Drupal\owlcarousel\Plugin\views\style;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * OWL...
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "owlcarousel",
 *   title = @Translation("Owl carousel"),
 *   help = @Translation("Owl carousel."),
 *   theme = "views_view_owlcarousel",
 *   display_types = {"normal"}
 * )
 */
class OwlCarouselStyle extends StylePluginBase {

  protected $usesRowPlugin = TRUE;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['preset'] = array('default' => array());

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $presets = $this->entityManager
      ->getStorage('owl_carousel_style')
      ->loadMultiple();

    $options = [];
    foreach ($presets as $preset) {
      /** @var \Drupal\owlcarousel\Entity\OwlCarouselStyle $preset */
      $options[$preset->getName()] = $preset->getLabel();
    }

    $form['preset'] = array(
      '#type' => 'select',
      '#title' => $this->t('Preset'),
      '#options' => $options,
      '#default_value' => $this->options['preset'],
    );
  }
}
