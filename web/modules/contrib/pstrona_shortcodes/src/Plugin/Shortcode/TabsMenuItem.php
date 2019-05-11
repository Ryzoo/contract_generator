<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_tabs_menu_item",
 *   title = "Tabs menu item",
 *   description = @Translation("Create a tabs item to tabs menu."),
 *   dependency = {
 *      "parent" = { "ps_tabs_menu" },
 *      "child" = {}
 *   },
 *   settings = {
 *     {
 *         "type" = "text",
 *         "atr_name" = "tabs_item_name",
 *         "name" = @Translation("Tabs item name"),
 *         "width" = "25",
 *         "value" = "Simple tab"
 *      },
 *   }
 * )
 */
class TabsMenuItem extends PsShortcodeBase {

  public function buildElement() {

    $itemName = isset($this->attr['tabs_item_name']) ? $this->attr['tabs_item_name'] : "###";

    return $this->renderShortcode("
      <div class='tabs-menu-item-name'>{$itemName}</div>
      <div class='tabs-menu-item'>
            {$this->text}
      </div>
    ");
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

