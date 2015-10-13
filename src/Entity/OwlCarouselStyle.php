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
 *   },
 *   config_export = {
 *     "name",
 *     "label",
 *     "items",
 *     "margin",
 *     "loop",
 *     "center",
 *     "mousedrag",
 *     "touchdrag",
 *     "pulldrag",
 *     "freedrag",
 *     "stagepadding",
 *     "merge",
 *     "mergefit",
 *     "autowidth",
 *     "startposition",
 *     "urlhashlistener",
 *     "nav",
 *     "navrewind",
 *     "navtextprev",
 *     "navtextnext",
 *     "slideby",
 *     "dots",
 *     "dotseach",
 *     "dotdata",
 *     "autoplay",
 *     "autoplaytimeout",
 *     "autoplayhoverpause",
 *     "smartspeed",
 *     "fluidspeed",
 *     "autoplayspeed",
 *     "navspeed",
 *     "dotsspeed",
 *     "dragendspeed",
 *     "callbacks",
 *     "responsive",
 *     "responsiverefreshrate",
 *     "responsivebaseelement",
 *     "responsiveclass",
 *
 *     "info",
 *
 *
 *     "themeclass",
 *     "baseclass",
 *     "itemclass",
 *     "centerclass",
 *     "activeclass",
 *     "navcontainerclass",
 *     "navclass",
 *     "controlsclass",
 *
 *     "nesteditemselector",
 *     "itemelement",
 *     "stageelement",
 *     "navcontainer",
 *     "dotscontainer",
 *
 *     "animateout",
 *     "animatein",
 *     "fallbackeasing",
 *
 *     "lazyload",
 *     "lazycontent",
 *
 *     "video",
 *     "videoheight",
 *     "videowidth",
 *
 *
 *   }
 * )
 */
class OwlCarouselStyle extends ConfigEntityBase {

  protected $name;
  protected $label;
  protected $items;
  protected $margin;
  protected $loop;
  protected $center;
  protected $mousedrag;
  protected $touchdrag;
  protected $pulldrag;
  protected $freedrag;
  protected $stagepadding;
  protected $merge;
  protected $mergefit;
  protected $autowidth;
  protected $startposition;
  protected $urlhashlistener;
  protected $nav;
  protected $navrewind;
  protected $navtextprev;
  protected $navtextnext;
  protected $slideby;
  protected $dots;
  protected $dotseach;
  protected $dotdata;
  protected $lazyload;
  protected $lazycontent;
  protected $autoplay;
  protected $autoplaytimeout;
  protected $autoplayhoverpause;
  protected $smartspeed;
  protected $fluidspeed;
  protected $autoplayspeed;
  protected $navspeed;
  protected $dotsspeed;
  protected $dragendspeed;
  protected $callbacks;
  protected $responsive;
  protected $responsiverefreshrate;
  protected $responsivebaseelement;
  protected $responsiveclass;
  protected $video;
  protected $videoheight;
  protected $videowidth;
  protected $animateout;
  protected $animatein;
  protected $fallbackeasing;
  protected $info;
  protected $nesteditemselector;
  protected $itemelement;
  protected $stageelement;
  protected $navcontainer;
  protected $dotscontainer;

  /*  theme configuration  */
  protected $theme;
  protected $themeclass;
  protected $baseclass;
  protected $itemclass;
  protected $centerclass;
  protected $activeclass;
  protected $navcontainerclass;
  protected $navclass;
  protected $controlsclass;
  protected $dotclass;
  protected $dotsclass;
  protected $autoheightclass;

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
  public function getMargin() {
    return $this->margin;
  }

  /**
   * @return mixed
   */
  public function getLoop() {
    return $this->loop;
  }

  /**
   * @return mixed
   */
  public function getCenter() {
    return $this->center;
  }

  /**
   * @return mixed
   */
  public function getMousedrag() {
    return $this->mousedrag;
  }

  /**
   * @return mixed
   */
  public function getTouchdrag() {
    return $this->touchdrag;
  }

  /**
   * @return mixed
   */
  public function getPulldrag() {
    return $this->pulldrag;
  }

  /**
   * @return mixed
   */
  public function getFreedrag() {
    return $this->freedrag;
  }

  /**
   * @return mixed
   */
  public function getStagepadding() {
    return $this->stagepadding;
  }

  /**
   * @return mixed
   */
  public function getMerge() {
    return $this->merge;
  }

  /**
   * @return mixed
   */
  public function getMergefit() {
    return $this->mergefit;
  }

  /**
   * @return mixed
   */
  public function getAutowidth() {
    return $this->autowidth;
  }

  /**
   * @return mixed
   */
  public function getStartposition() {
    return $this->startposition;
  }

  /**
   * @return mixed
   */
  public function getUrlhashlistener() {
    return $this->urlhashlistener;
  }

  /**
   * @return mixed
   */
  public function getNav() {
    return $this->nav;
  }

  /**
   * @return mixed
   */
  public function getNavrewind() {
    return $this->navrewind;
  }

  /**
   * @return mixed
   *
   * TODO must be merged in array with Navtextnext;
   */
  public function getNavtextprev() {
    return $this->navtextprev;
  }

  /**
   * @return mixed
   *
   * TODO must be merged in array with Navtextprev;
   */
  public function getNavtextnext() {
    return $this->navtextnext;
  }

  /**
   * @return mixed
   */
  public function getSlideby() {
    return $this->slideby;
  }

  /**
   * @return mixed
   */
  public function getDots() {
    return $this->dots;
  }

  /**
   * @return mixed
   */
  public function getDotseach() {
    return $this->dotseach;
  }

  /**
   * @return mixed
   */
  public function getDotdata() {
    return $this->dotdata;
  }

  /**
   * @return mixed
   */
  public function getLazyload() {
    return $this->lazyload;
  }

  /**
   * @return mixed
   */
  public function getLazycontent() {
    return $this->lazycontent;
  }

  /**
   * @return mixed
   */
  public function getAutoplay() {
    return $this->autoplay;
  }

  /**
   * @return mixed
   */
  public function getAutoplaytimeout() {
    return $this->autoplaytimeout;
  }

  /**
   * @return mixed
   */
  public function getAutoplayhoverpause() {
    return $this->autoplayhoverpause;
  }

  /**
   * @return mixed
   */
  public function getSmartspeed() {
    return $this->smartspeed;
  }

  /**
   * @return mixed
   */
  public function getFluidspeed() {
    return $this->fluidspeed;
  }

  /**
   * @return mixed
   */
  public function getAutoplayspeed() {
    return $this->autoplayspeed;
  }

  /**
   * @return mixed
   */
  public function getNavspeed() {
    return $this->navspeed;
  }

  /**
   * @return mixed
   */
  public function getDotsspeed() {
    return $this->dotsspeed;
  }

  /**
   * @return mixed
   */
  public function getDragendspeed() {
    return $this->dragendspeed;
  }

  /**
   * @return mixed
   */
  public function getCallbacks() {
    return $this->callbacks;
  }

  /**
   * @return mixed
   */
  public function getResponsive() {
    return $this->responsive;
  }

  /**
   * @return mixed
   */
  public function getresponsiverefreshrate() {
    return $this->responsiverefreshrate;
  }

  /**
   * @return mixed
   */
  public function getResponsivebaseelement() {
    return $this->responsivebaseelement;
  }

  /**
   * @return mixed
   */
  public function getResponsiveclass() {
    return $this->responsiveclass;
  }

  /**
   * @return mixed
   */
  public function getVideo() {
    return $this->video;
  }

  /**
   * @return mixed
   */
  public function getVideoheight() {
    return $this->videoheight;
  }

  /**
   * @return mixed
   */
  public function getVideowidth() {
    return $this->videowidth;
  }

  /**
   * @return mixed
   */
  public function getAnimateout() {
    return $this->animateout;
  }

  /**
   * @return mixed
   */
  public function getAnimatein() {
    return $this->animatein;
  }

  /**
   * @return mixed
   */
  public function getFallbackeasing() {
    return $this->fallbackeasing;
  }

  /**
   * @return mixed
   */
  public function getInfo() {
    return $this->info;
  }

  /**
   * @return mixed
   */
  public function getNesteditemselector() {
    return $this->nesteditemselector;
  }

  /**
   * @return mixed
   */
  public function getItemelement() {
    return $this->itemelement;
  }

  /**
   * @return mixed
   */
  public function getStageelement() {
    return $this->stageelement;
  }

  /**
   * @return mixed
   */
  public function getNavcontainer() {
    return $this->navcontainer;
  }

  /**
   * @return mixed
   */
  public function getDotscontainer() {
    return $this->dotscontainer;
  }

  /* theme */
  /**
   * @return mixed
   */
  public function getThemeclass() {
    return $this->themeclass;
  }

  /**
   * @return mixed
   */
  public function getBaseclass() {
    return $this->baseclass;
  }

  /**
   * @return mixed
   */
  public function getItemclass() {
    return $this->itemclass;
  }

  /**
   * @return mixed
   */
  public function getCenterclass() {
    return $this->centerclass;
  }

  /**
   * @return mixed
   */
  public function getActiveclass() {
    return $this->activeclass;
  }

  /**
   * @return mixed
   */
  public function getNavcontainerclass() {
    return $this->navcontainerclass;
  }

  /**
   * @return mixed
   */
  public function getNavclass() {
    return $this->navclass;
  }

  /**
   * @return mixed
   */
  public function getControlsclass() {
    return $this->controlsclass;
  }

  /**
   * @return mixed
   */
  public function getDotclass() {
    return $this->dotclass;
  }

  /**
   * @return mixed
   */
  public function getDotsclass() {
    return $this->dotsclass;
  }

  /**
   * @return mixed
   */
  public function getAutoheightclass() {
    return $this->autoheightclass;
  }
}
