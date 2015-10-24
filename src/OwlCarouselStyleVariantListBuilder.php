<?php

namespace Drupal\owlcarousel;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;
use Drupal\owlcarousel\Entity\OwlCarouselStyle;

/**
 * Class OwlCarouselStyleVariantListBuilder
 */
class OwlCarouselStyleVariantListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Variant name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEntityIds() {
    $owlCarouselStyleId = \Drupal::request()->get('owl_carousel_style');

    /** @var OwlCarouselStyle $owlCarouselStyle */
    $owlCarouselStyle = \Drupal::entityManager()->getStorage('owl_carousel_style')->load($owlCarouselStyleId);
    $variants = $owlCarouselStyle->getVariants();

    if(!$variants) {
      return [];
    }

    return $variants;
  }
}
