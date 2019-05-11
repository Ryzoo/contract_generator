<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic icon shortcode
 *
 * @Shortcode(
 *   id = "ps_counter",
 *   title = "Counter",
 *   description = @Translation("Add animated counters."),
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "counter_type",
 *         "name" = @Translation("A counter type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "ps-counter-circle-full" = "Circular with background",
 *              "ps-counter-circle-bordered" = "Circular only border",
 *              "ps-counter-rectangle-full" = "Rectangle with background",
 *              "ps-counter-rectangle-bordered" = "Rectangle only border"
 *         },
 *         "value" = "ps-counter-circle-full"
 *      },
 *     {
 *         "type" = "icon",
 *         "atr_name" = "icon_name",
 *         "name" = @Translation("Select icon to show in"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "counter_start",
 *         "name" = @Translation("Counter start number"),
 *         "width" = "25",
 *         "value" = "0"
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "counter_end",
 *         "name" = @Translation("Counter end number"),
 *         "width" = "25",
 *         "value" = "100"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "icon_size",
 *         "name" = @Translation("Icon size"),
 *         "width" = "25",
 *         "value" = "25"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "border_size",
 *         "name" = @Translation("Border size"),
 *         "width" = "25",
 *         "value" = "2"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "icon_color",
 *         "name" = @Translation("Icon color"),
 *         "width" = "25",
 *         "value" = "#000000"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "back_color",
 *         "name" = @Translation("Background color"),
 *         "width" = "25",
 *         "value" = "#000000"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "border_color",
 *         "name" = @Translation("Border color"),
 *         "width" = "25",
 *         "value" = "#000000"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "text_color",
 *         "name" = @Translation("Text color"),
 *         "width" = "25",
 *         "value" = "#ffffff"
 *      },
 *      {
 *         "type" = "html",
 *         "atr_name" = "content_text",
 *         "name" = @Translation("Content text"),
 *         "width" = "100",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Counter extends PsShortcodeBase {

  public function buildElement() {
    $type = isset($this->attr['counter_type']) ? $this->attr['counter_type'] : "ps-counter-circle-full";
    $icon = isset($this->attr['icon_name']) ? $this->attr['icon_name'] : "";
    $start = isset($this->attr['counter_start']) ? (float) $this->attr['counter_start'] : 0.0;
    $end = isset($this->attr['counter_end']) ? (float) $this->attr['counter_end'] : 100.0;
    $iconSize = isset($this->attr['icon_size']) ? (int) $this->attr['icon_size'] : 25;
    $iconColor = isset($this->attr['icon_color']) ? $this->attr['icon_color'] : "#000000";
    $borderSize = isset($this->attr['border_size']) ? (int) $this->attr['border_size'] : 2;
    $backgroundColor = isset($this->attr['back_color']) ? $this->attr['back_color'] : "#000000";
    $textColor = isset($this->attr['text_color']) ? $this->attr['text_color'] : "#ffffff";
    $borderColor = isset($this->attr['border_color']) ? $this->attr['border_color'] : "#000000";
    $htmlAfter = isset($this->attr['content_text']) ? $this->attr['content_text'] : "";

    $iconHtml = "<span class='ps-counter-icon {$icon}' style='font-size: {$iconSize}px; color: {$iconColor};'></span>";
    if (strlen($icon) <= 0) {
      $iconHtml = "";
    }

    $html = "
      <div class='ps-counter {$type}'>
        <div class='ps-counter-in' style='background: {$backgroundColor}; border-color: {$borderColor}; border-width: {$borderSize}px'>
          <div class='ps-counter-content'>
            {$iconHtml}
            <h4 class='ps-counter-number' style='color: {$textColor}' data-from='{$start}' data-to='{$end}' data-speed='2500'></h4>
          </div>
        </div>
        <div class='ps-counter-after'>
          {$htmlAfter}
        </div>
      </div>
    ";

    return $this->renderShortcode($html,true);
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

