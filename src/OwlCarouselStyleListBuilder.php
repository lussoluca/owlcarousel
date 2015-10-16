<?php

namespace Drupal\owlcarousel;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Class OwlCarouselStyleListBuilder
 */
class OwlCarouselStyleListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Style name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  public function getDefaultOperations(EntityInterface $entity) {
    /** @var \Drupal\Core\Config\Entity\ConfigEntityInterface $entity */
    $operations = parent::getDefaultOperations($entity);

    $operations['variants'] = array(
      'title' => t('Variants'),
      'weight' => 10,
      'url' => Url::fromRoute('entity.owl_carousel_style_variant.collection', ['owl_carousel_style' => $entity->id()]),
    );

    return $operations;
  }
}
