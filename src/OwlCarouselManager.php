<?php

namespace Drupal\owlcarousel;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\owlcarousel\Entity\OwlCarouselSettingsInterface;

/**
 * Class OwlCarouselManager
 */
class OwlCarouselManager {

  /**
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   */
  public function __construct(EntityManagerInterface $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * @param bool $include_empty
   *
   * @return array
   */
  public function owlCarouselStyleOptions($include_empty = TRUE) {
    $styles = $this->entityManager->getStorage('owl_carousel_style')
      ->loadMultiple();
    $options = array();
    if ($include_empty && !empty($styles)) {
      $options[''] = t('- None -');
    }
    foreach ($styles as $name => $style) {
      $options[$name] = $style->label();
    }

    if (empty($options)) {
      $options[''] = t('No defined styles');
    }
    return $options;
  }

  /**
   * @param \Drupal\owlcarousel\Entity\OwlCarouselSettingsInterface $entity
   */
  public function generateVariants(OwlCarouselSettingsInterface $entity) {
    /** @var \Drupal\owlcarousel\Entity\OwlCarouselStyle $entity */
    $generalName = $entity->getName() . '_general';

    $this->entityManager
      ->getStorage('owl_carousel_style_variant')
      ->create([
        'name' => $generalName,
        'label' => \Drupal::translation()
          ->translate('@label General', ['@label' => $entity->label()]),
      ])->save();
    $entity->addVariant($generalName);

    if ($entity->isResponsive()) {
//      foreach($entity->getMediaQueries()) {
      $variantName = $entity->getName() . '_mediaquery_1';
      $this->entityManager
        ->getStorage('owl_carousel_style_variant')
        ->create([
          'name' => $variantName,
          'label' => \Drupal::translation()
            ->translate('@label Media Query 1', ['@label' => $entity->label()]),
        ])->save();
      $entity->addVariant($variantName);
//      }
    }
  }
}
