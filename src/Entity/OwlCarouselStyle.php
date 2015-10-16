<?php

namespace Drupal\owlcarousel\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines an Owl carousel style configuration entity.
 *
 * @ConfigEntityType(
 *   id = "owl_carousel_style",
 *   label = @Translation("Owl carousel style"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\owlcarousel\Form\OwlCarouselStyleAddForm",
 *       "edit" = "Drupal\owlcarousel\Form\OwlCarouselStyleEditForm",
 *       "delete" = "Drupal\owlcarousel\Form\OwlCarouselStyleDeleteForm",
 *     },
 *     "list_builder" = "Drupal\owlcarousel\OwlCarouselStyleListBuilder",
 *   },
 *   admin_permission = "administer owl carousel styles",
 *   config_prefix = "owlcarousel",
 *   entity_keys = {
 *     "id" = "name",
 *     "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/user-interface/owlcarousel/manage/{owl_carousel_style}",
 *     "delete-form" = "/admin/config/user-interface/owlcarousel/manage/{owl_carousel_style}/delete",
 *     "collection" = "/admin/config/user-interface/owlcarousel",
 *     "variants" = "/admin/config/user-interface/owlcarousel/manage/{owl_carousel_style}/variants",
 *   },
 *   config_export = {
 *     "name",
 *     "label",
 *     "items",
 *     "responsive",
 *     "variants",
 *   }
 * )
 */
class OwlCarouselStyle extends ConfigEntityBase implements OwlCarouselSettingsInterface {

  protected $name;
  protected $label;
  protected $items;
  protected $responsive;

  /**
   * @var int
   */
  protected $variants;

  /**
   * Overrides Drupal\Core\Entity\Entity::id().
   */
  public function id() {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * @return mixed
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * @return mixed
   */
  public function isResponsive() {
    return $this->responsive;
  }

  /**
   * @return mixed
   */
  public function getVariants() {
    return $this->variants;
  }

  /**
   * @param OwlCarouselStyleVariant|int $variant
   */
  public function addVariant($variant) {
    if(is_object($variant)) {
      $variant = $variant->id();
    }

    $this->variants[] = $variant;
  }

  /**
   * {@inheritdoc}
   */
  public function toJsonArray() {
    $json = [];

    $json['items'] = $this->getItems();

    foreach($this->getVariants() as $id) {
      /** @var OwlCarouselSettingsInterface $variant */
      $variant = $this->entityManager()->getStorage('owl_carousel_style_variant')->load($id);
      $json += $variant->toJsonArray();
    }

    return $json;
  }
}
