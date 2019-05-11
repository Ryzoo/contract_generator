<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_row",
 *   title = "Row",
 *   description = @Translation("Create a row contains columns"),
 *   group = "1",
 *   dependency = {
 *      "parent" = {},
 *      "child" = { "ps_col" }
 *   },
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "direction",
 *         "name" = @Translation("Row direction"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "d_column" = "column",
 *             "d_row" = "row"
 *         },
 *         "value" = "d_row"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "align_dir",
 *         "name" = @Translation("Aligin items in row"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "center" = "center",
 *             "flex-start" = "flex-start",
 *             "flex-end" = "flex-end",
 *             "stretch" = "stretch"
 *         },
 *         "value" = "flex-start"
 *      }
 *   }
 * )
 */
class Row extends PsShortcodeBase  {

  public function buildElement(){
      $alignDir = isset($this->attr['align_dir']) ? $this->attr['align_dir'] : "flex-start";
      $directionDir = (isset($this->attr['direction']) && $this->attr['direction'] === "d_column") ? "flex-direction: column !important;" : "flex-direction: row !important;";
      $align = "justify-content: {$alignDir} !important;";

      $this->addDefStyle("$align $directionDir flex-wrap: wrap;");
      $this->addDefClass('row');
      return $this->renderShortcode($this->text,false,false);
  }

  public function tips($long = FALSE) {
      return $this->createTips($long, "Long text", "Short text");
  }
}
