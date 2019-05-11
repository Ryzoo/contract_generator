<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_gallery",
 *   title = "Gallery",
 *   description = @Translation("Create gallery container."),
 *   dependency = {
 *      "parent" = {},
 *      "child" = { "ps_image", "ps_video"  }
 *   },
 *   settings = {
 *     {
 *         "type" = "number",
 *         "atr_name" = "gap",
 *         "name" = @Translation("Grid gap (px)"),
 *         "width" = "25",
 *         "value" = "0"
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "img_count",
 *         "name" = @Translation("How more img per row"),
 *         "width" = "25",
 *         "value" = "4"
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "row_height",
 *         "name" = @Translation("Grid row height (px)"),
 *         "width" = "25",
 *         "value" = "200"
 *      },
 *   }
 * )
 */
class Gallery extends PsShortcodeBase
{
    public function buildElement()
    {
        $gap = (isset($this->attr['gap']) ? $this->attr['gap'] : 0) . "px";
        $imgCount = isset($this->attr['img_count']) ? (int) $this->attr['img_count'] : 0;
        $rowHeight = (isset($this->attr['row_height']) ? $this->attr['row_height'] : 0) . "px";

        $gridGenerated = str_repeat("1fr ",$imgCount);

        $this->addDefStyle("display:grid; grid-template-columns: {$gridGenerated}; grid-auto-rows: {$rowHeight}; grid-column-gap: {$gap}; grid-row-gap: {$gap};");
        $this->addDefClass('ps_image_gallery');
        return $this->renderShortcode($this->text, true);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

