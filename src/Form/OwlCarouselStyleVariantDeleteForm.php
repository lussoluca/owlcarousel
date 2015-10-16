<?php

namespace Drupal\owlcarousel\Form;

use Drupal\Core\Entity\EntityDeleteForm;

/**
 * Class OwlCarouselStyleVariantDeleteForm
 */
class OwlCarouselStyleVariantDeleteForm extends EntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    $url = parent::getCancelUrl();

    $owlCarouselStyle = $this->getRequest()->get('owl_carousel_style');
    $url->setRouteParameter('owl_carousel_style', $owlCarouselStyle);

    return $url;
  }
}
