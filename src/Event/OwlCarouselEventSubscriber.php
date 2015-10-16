<?php

namespace Drupal\owlcarousel\Event;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class OwlCarouselEventSubscriber
 */
class OwlCarouselEventSubscriber implements EventSubscriberInterface {

  /**
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   */
  public function onConfigDelete(ConfigCrudEvent $event) {
    $config = $event->getConfig();

    if (strstr($config->getName(), 'owlcarousel.owlcarousel.')) {
      $storage = \Drupal::entityManager()
        ->getStorage('owl_carousel_style_variant');

      foreach ($config->get('variants') as $variant) {
        $storage->delete($variant);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ConfigEvents::DELETE][] = array('onConfigDelete', 255);
    return $events;
  }

}
