<?php

namespace Drupal\owlcarousel\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class OwlCarouselStyleVariantEditForm
 */
class OwlCarouselStyleVariantEditForm extends OwlCarouselStyleVariantBaseForm {

  /**
   * {@inheritdoc}
   *
   * Add owl_carousel_style route parameter to delete link.
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);

    /** @var Url $route_info */
    $route_info = $actions['delete']['#url'];

    $owlCarouselStyle = $this->getRequest()->get('owl_carousel_style');
    $route_info->setRouteParameter('owl_carousel_style', $owlCarouselStyle);

    return $actions;
  }
}
