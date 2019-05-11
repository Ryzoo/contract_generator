<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic icon shortcode
 *
 * @Shortcode(
 *   id = "ps_icon",
 *   title = "Icon",
 *   description = @Translation("Enter a icon."),
 *   settings = {
 *     {
 *         "type" = "icon",
 *         "atr_name" = "icon_name",
 *         "name" = @Translation("Select icon"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "icon_position",
 *         "name" = @Translation("Icon position in container"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "center" = "Center",
 *              "top" = "Top",
 *              "tr" = "Top-Right",
 *              "right" = "Right",
 *              "br" = "Bottom-Right",
 *              "bottom" = "Bottom",
 *              "bl" = "Bottom-Left",
 *              "left" = "Left",
 *              "tl" = "Top-Left"
 *         },
 *         "value" = "center"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "icon_size",
 *         "name" = @Translation("Icon size"),
 *         "width" = "25",
 *         "value" = "25"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "icon_color",
 *         "name" = @Translation("Icon color"),
 *         "width" = "25",
 *         "value" = "#000000"
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "icon_link",
 *         "name" = @Translation("Icon reference"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_back_container",
 *         "name" = @Translation("Use container with background?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "back_size",
 *         "name" = @Translation("Back size (add %, px etc.)"),
 *         "width" = "50",
 *         "value" = "100%"
 *      },
 *      {
 *         "type" = "color",
 *         "atr_name" = "back_color",
 *         "name" = @Translation("Background color"),
 *         "width" = "50",
 *         "value" = "#000000"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "back_round",
 *         "name" = @Translation("Round of background (%)"),
 *         "width" = "50",
 *         "value" = "100"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Icon extends PsShortcodeBase {

  public function buildElement() {
    $iconName = isset($this->attr['icon_name']) ? $this->attr['icon_name'] : "";
    $html = "Edit this, and select icon or remove this shortcode";

    $backColor = isset($this->attr['back_color']) ? $this->attr['back_color'] : "#00000";
    $backSize = isset($this->attr['back_size']) ? $this->attr['back_size'] : '100%';
    $backRound = isset($this->attr['back_round']) ? $this->attr['back_round'] : '100';
    $isBackContainer = (isset($this->attr['is_back_container']) && $this->attr['is_back_container'] === "true") ? true : false;

    if (strlen($iconName) > 0) {
      $iconPosition = $this->attr['icon_position'];
      $iconSize = $this->attr['icon_size'];
      $iconColor= $this->attr['icon_color'];
      $iconLink= isset($this->attr['icon_link']) ? $this->attr['icon_link'] : "";

      if( strlen($iconLink) > 0){
        $html = "<a href='{$iconLink}' class='link-with-icon icon-position icon-position-{$iconPosition}'><i class='{$iconName} ' style='font-size: {$iconSize}px; color:{$iconColor}'></i></a>";
      }else{
        $html = "<i  class='{$iconName} icon-position icon-position-{$iconPosition}' style='font-size: {$iconSize}px; color:{$iconColor};'></i>";
      }
    }

    if (!isset($this->attr['style'])) {
      $this->attr['style'] = "";
    }

    $additionalSt = '';
    if($isBackContainer){
      $additionalSt = "background: {$backColor};";
    }

    $this->addDefStyle("display:block !important; {$additionalSt} position: relative; margin: auto; width: {$backSize} !important; border-radius: {$backRound}%; padding-top:{$backSize} !important;");

    return $this->renderShortcode($html, true);
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

