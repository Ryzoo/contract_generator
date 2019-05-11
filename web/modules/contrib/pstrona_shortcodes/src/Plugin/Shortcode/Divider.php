<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_divider",
 *   title = "Divider",
 *   description = @Translation("Create divider."),
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "divider_type",
 *         "name" = @Translation("Divider type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "v1" = "Default divider",
 *              "v2" = "Gradient divider with main color",
 *              "v3" = "Gradient divider with gray color",
 *         },
 *         "value" = "v1"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Divider extends PsShortcodeBase
{

    public function buildElement()
    {
        $divider_type = isset($this->attr['divider_type']) ? $this->attr['divider_type'] : 'v1';
        $return_divider = "";
        switch ($divider_type) {
            case "v1":
                $return_divider = "
                    <hr/>
                ";
                break;
            case "v2":
                $return_divider = "
                    <hr class='ps-gradient-divider'>
                ";
                break;
            case "v3":
                $return_divider = "
                    <hr class='ps-gradient-default-divider'>
                ";
                break;
        }

        $this->addDefClass('ps-divider-container');


        return $this->renderShortcode($return_divider);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

