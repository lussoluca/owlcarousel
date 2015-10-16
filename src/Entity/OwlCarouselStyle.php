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
 *     "variants",
 *   }
 * )
 */
class OwlCarouselStyle extends ConfigEntityBase {

  protected $name;
  protected $label;
  protected $items;

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
   * @return OwlCarouselStyleVariant
   */
  public function getVariants() {
    return $this->variants;
  }

  /**
   * @param OwlCarouselStyleVariant $variant
   */
  public function addVariant($variant) {
    $this->variants[] = $variant->id();
  }
}
