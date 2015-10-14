<?php

/**
 * @file
 * Contains \Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase.
 */

namespace Drupal\owlcarousel\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;

/**
 * Base class for owlcarousel file formatters.
 */
abstract class OwlCarouselFormatterBase extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'owl_carousel_style' => '',
    ) + parent::defaultSettings();
  }
}
