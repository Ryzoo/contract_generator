<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_container",
 *   title = "Container",
 *   description = @Translation("Create a container"),
 *   group = "1",
 *   settings = {
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_fluid",
 *         "name" = @Translation("Use full page width?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_paralax",
 *         "name" = @Translation("Use paralax background?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "file",
 *         "atr_name" = "paralax_file",
 *         "name" = @Translation("Paralax file"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_filter",
 *         "name" = @Translation("Use paralax filter?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "filter_color",
 *         "name" = @Translation("Filter color?"),
 *         "width" = "50",
 *         "value" = "#ffffff"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "filter_opacity",
 *         "name" = @Translation("Filter opacity?"),
 *         "width" = "50",
 *         "value" = "50"
 *      }
 *   }
 *
 * )
 */
class Container extends PsShortcodeBase {

  public function buildElement() {

    $class = "container";

    $filter = isset($this->attr['is_filter']) && $this->attr['is_filter'] === 'true' ? true : false;
    $filterColor = isset($this->attr['filter_color']) ? $this->attr['filter_color'] : "#ffffff";
    $filterOpacity = isset($this->attr['filter_opacity']) ? (int) $this->attr['filter_opacity'] : 50;
    $filterOpacity = $filterOpacity / 100.0;

    $paralax = isset($this->attr['is_paralax']) && $this->attr['is_paralax'] === 'true' ? true : false;
    $fluid = isset($this->attr['is_fluid']) && $this->attr['is_fluid'] === 'true' ? true : false;
    $file = isset($this->attr['paralax_file']) &&  strlen($this->attr['paralax_file']) > 0 ? $this->getUrlFromFile($this->attr['paralax_file']) : "";

    if ($fluid) {
      $class = "container-fluid";
    }

    if($paralax && strlen($file) > 0){
      $this->addDefStyle("background-image: url('{$file}');");
      $this->addDefClass("ps-paralax");
    }

    if($filter){
      $this->text = "<div class='ps-paralax-filter' style='background: {$filterColor}; opacity: {$filterOpacity}'></div>".$this->text;
    }

    $this->addDefClass($class);

    return $this->renderShortcode($this->text, FALSE, FALSE);
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}
