<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_tabs_menu",
 *   title = "Tabs menu",
 *   description = @Translation("Create a tabs menu."),
 *   dependency = {
 *      "parent" = {},
 *      "child" = { "ps_tabs_menu_item" }
 *   },
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "name",
 *         "name" = @Translation("Tabs type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "default" = "Domyślny"
 *         },
 *         "value" = "default"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "tabs_header",
 *         "name" = @Translation("Tabs header text"),
 *         "width" = "25",
 *         "value" = "Simple tab menu"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "tabs_description",
 *         "name" = @Translation("Tabs description text"),
 *         "width" = "25",
 *         "value" = ""
 *      }
 *   }
 * )
 */
class TabsMenu extends PsShortcodeBase {

  public function buildElement() {

    $type = isset($this->attr['name']) ? $this->attr['name'] : "default";
    $tabsHeader = isset($this->attr['tabs_header']) ? $this->attr['tabs_header'] : "";
    $tabsDescription = isset($this->attr['tabs_description']) ? $this->attr['tabs_description'] : "";

    return $this->renderShortcode("
      <div class='tabs-menu-container tabs-menu-type-{$type}'>
        <h1 class='tabs-menu-container--header'>{$tabsHeader}</h1>
        <p class='tabs-menu-container--description'>{$tabsDescription}</p>
        <div class='tabs-menu-container--tabs'></div>
        <div class='tabs-menu-container--content'>
            {$this->text}
        </div>
      </div>
    ");
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

