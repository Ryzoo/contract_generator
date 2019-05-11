<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_col",
 *   title = "Column",
 *   description = @Translation("Create a column"),
 *   group = "1",
 *   dependency = {
 *      "parent" = { "ps_row" },
 *      "child" = {}
 *   },
 *   settings = {
 *      {
 *         "type" = "number",
 *         "atr_name" = "sm",
 *         "name" = @Translation("Rozmiar sm"),
 *         "width" = "25",
 *         "value" = "12"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "md",
 *         "name" = @Translation("Rozmiar md"),
 *         "width" = "25",
 *         "value" = "12"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "lg",
 *         "name" = @Translation("Rozmiar lg"),
 *         "width" = "25",
 *         "value" = "12"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "xl",
 *         "name" = @Translation("Rozmiar xl"),
 *         "width" = "25",
 *         "value" = "12"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "direction",
 *         "name" = @Translation("Direction"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "d_column" = "column",
 *             "d_row" = "row"
 *         },
 *         "value" = "d_column"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "align_dir",
 *         "name" = @Translation("Aligin items in col"),
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
class Column extends PsShortcodeBase
{
    public function buildElement()
    {
        $class = '';
        if(isset($this->attr['sm']) && strlen($this->attr['sm']) > 0)
            $class .= ' col-sm-'.$this->attr['sm'];

        if(isset($this->attr['md']) && strlen($this->attr['md']) > 0)
            $class .= ' col-md-'.$this->attr['md'];

        if(isset($this->attr['lg']) && strlen($this->attr['lg']) > 0)
            $class .= ' col-lg-'.$this->attr['lg'];

        if(isset($this->attr['xl']) && strlen($this->attr['xl']) > 0)
            $class .= ' col-xl-'.$this->attr['xl'];

        if ($this->attr['direction'] === "d_column") {
          $class .= " ps-shortcode-col";
        } else {
          $class .= " ps-shortcode-flex-none";
        }

        $alignDir = isset($this->attr['align_dir']) ? $this->attr['align_dir'] : "center";
        $align = "justify-content: {$alignDir} !important;";

        $this->addDefStyle("$align");
        $this->addDefClass($class);
        return $this->renderShortcode($this->text,false,false);
    }

    public function tips($long = false)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}
