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
 *
 *
 *     "responsive",
 *     "responsivequeryone",
 *     "responsiveitemone",
 *     "responsivequerytwo",
 *     "responsiveitemtwo",
 *     "responsivequerythree",
 *     "responsiveitemthree",
 *     "responsivequeryfour",
 *     "responsiveitemfour",
 *     "responsivequeryfive",
 *     "responsiveitemfive",
 *
 *     "responsiverefreshrate",
 *     "responsivebaseelement",
 *     "responsiveclass",
 *
 *     "loop",
 *     "center",
 *     "merge",
 *     "mergefit",
 *     "autowidth",
 *     "rtl",
 *
 *     "autoplay",
 *     "autoplayspeed",
 *     "autoplaytimeout",
 *     "autoplayhoverpause",
 *
 *     "nav",
 *     "navrewind",
 *     "navtextprev",
 *     "navtextnext",
 *     "slideby",
 *     "dots",
 *     "dotseach",
 *     "dotdata",
 *     "startposition",
 *
 *     "mousedrag",
 *     "touchdrag",
 *     "pulldrag",
 *     "freedrag",
 *
 *     "smartspeed",
 *     "fluidspeed",
 *     "navspeed",
 *     "dotsspeed",
 *     "dragendspeed",
 *
 *     "themeclass",
 *     "baseclass",
 *     "stageelement",
 *     "itemclass",
 *     "itemelement",
 *     "nesteditemselector",
 *     "controlsclass",
 *     "dotsclass",
 *     "dotscontainer",
 *     "navcontainerclass",
 *     "navclassprev",
 *     "navclassnext",
 *     "navcontainer",
 *     "centerclass",
 *     "activeclass",
 *     "autoheightclass",
 *     "margin",
 *     "stagepadding",
 *
 *     "animatelib",
 *     "animateoutlib",
 *     "animateinlib",
 *     "animateout",
 *     "animatein",
 *     "fallbackeasing",
 *
 *     "autoheight",
 *
 *     "video",
 *     "videoheight",
 *     "videowidth",
 *
 *     "lazyload",
 *     "lazycontent",
 *
 *     "urlhashlistener",
 *     "callbacks",
 *     "info",
 *
 *   }
 * )
 */
class OwlCarouselStyle extends ConfigEntityBase {

  protected $name;
  protected $label;
  protected $items;

  protected $responsive;

  protected $responsiveitemone;
  protected $responsivequeryone;

  protected $responsiveitemtwo;
  protected $responsivequerytwo;

  protected $responsiveitemthree;
  protected $responsivequerythree;

  protected $responsiveitemfour;
  protected $responsivequeryfour;

  protected $responsiveitemfive;
  protected $responsivequeryfive;

  protected $responsiverefreshrate;
  protected $responsivebaseelement;
  protected $responsiveclass;

  protected $loop;
  protected $center;
  protected $merge;
  protected $mergefit;
  protected $autowidth;
  protected $rtl;

  protected $autoplay;
  protected $autoplaytimeout;
  protected $autoplayhoverpause;

  protected $nav;
  protected $navrewind;
  protected $navtextprev;
  protected $navtextnext;
  protected $slideby;
  protected $dots;
  protected $dotseach;
  protected $dotdata;
  protected $startposition;

  protected $mousedrag;
  protected $touchdrag;
  protected $pulldrag;
  protected $freedrag;

  protected $autoplayspeed;
  protected $smartspeed;
  protected $fluidspeed;
  protected $navspeed;
  protected $dotsspeed;
  protected $dragendspeed;

  protected $theme;
  protected $themeclass;
  protected $baseclass;
  protected $stageelement;
  protected $itemclass;
  protected $itemelement;
  protected $nesteditemselector;
  protected $centerclass;
  protected $activeclass;
  protected $navcontainerclass;
  protected $navclassprev;
  protected $navclassnext;
  protected $navcontainer;
  protected $controlsclass;
  protected $dotclass;
  protected $dotsclass;
  protected $dotscontainer;
  protected $autoheightclass;
  protected $margin;
  protected $stagepadding;

  protected $animatelib;
  protected $animateoutlib;
  protected $animateinlib;
  protected $animateout;
  protected $animatein;
  protected $fallbackeasing;

  protected $lazyload;
  protected $lazycontent;

  protected $autoheight;

  protected $video;
  protected $videoheight;
  protected $videowidth;

  protected $urlhashlistener;
  protected $callbacks;
  protected $info;

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
  public function getRtl() {
    return $this->rtl;
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
  public function getAutoheight() {
    return $this->autoheight;
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
  public function getAnimatelib() {
    return $this->animatelib;
  }

  /**
   * @return mixed
   */
  public function getAnimateoutlib() {
    return $this->animateoutlib;
  }

  /**
   * @return mixed
   */
  public function getAnimateinlib() {
    return $this->animateinlib;
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
  public function getNavclassprev() {
    return $this->navclassprev;
  }

  /**
   * @return mixed
   */
  public function getNavclassnext() {
    return $this->navclassnext;
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

  /**
   * @return mixed
   */
  public function getResponsiveitemone() {
    return $this->responsiveitemone;
  }

  /**
   * @return mixed
   */
  public function getResponsiveitemtwo() {
    return $this->responsiveitemtwo;
  }

  /**
   * @return mixed
   */
  public function getResponsiveitemthree() {
    return $this->responsiveitemthree;
  }

  /**
   * @return mixed
   */
  public function getResponsiveitemfour() {
    return $this->responsiveitemfour;
  }

  /**
   * @return mixed
   */
  public function getResponsiveitemfive() {
    return $this->responsiveitemfive;
  }

  /**
   * @return mixed
   */
  public function getResponsivequeryone() {
    return $this->responsivequeryone;
  }

  /**
   * @return mixed
   */
  public function getResponsivequerytwo() {
    return $this->responsivequerytwo;
  }

  /**
   * @return mixed
   */
  public function getResponsivequerythree() {
    return $this->responsivequerythree;
  }

  /**
   * @return mixed
   */
  public function getResponsivequeryfour() {
    return $this->responsivequeryfour;
  }

  /**
   * @return mixed
   */
  public function getResponsivequeryfive() {
    return $this->responsivequeryfive;
  }
}
