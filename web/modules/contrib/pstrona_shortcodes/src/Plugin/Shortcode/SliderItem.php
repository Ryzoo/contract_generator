<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_slider_item",
 *   title = "Slider item",
 *   description = @Translation("Create slider item with content. ( this is one slide )"),
 *   dependency = {
 *      "parent" = { "ps_slider" },
 *      "child" = { }
 *   },
 *   settings = {
 *   }
 * )
 */
class SliderItem extends PsShortcodeBase {

  public function buildElement() {
    $this->addDefClass('swiper-slide');
    return $this->renderShortcode($this->text,false,false);
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

