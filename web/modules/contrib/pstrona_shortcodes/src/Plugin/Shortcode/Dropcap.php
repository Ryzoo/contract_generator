<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_dropcap",
 *   title = "Dropcap",
 *   description = @Translation("Create blockdropcap."),
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "dropcap_type",
 *         "name" = @Translation("Dropcap type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "v1" = "Default dropcap",
 *              "v2" = "Dropcap with color background",
 *         },
 *         "value" = "v1"
 *      }
 *   }
 * )
 */
class Dropcap extends PsShortcodeBase
{

    public function buildElement()
    {
        $dropcap_type = isset($this->attr['dropcap_type']) ? $this->attr['dropcap_type'] : 'v1';

        $return_dropcap = "";
        switch ($dropcap_type) {
            case "v1":
        $return_dropcap = "
                    <div class='ps-dropcap-v1'>
                        {$this->text}
                    </div>
                ";
                break;
            case "v2":
                $return_dropcap = "
                    <div class='ps-dropcap-v2'>
                        {$this->text}
                    </div>
                ";
                break;
        }


        return $this->renderShortcode($return_dropcap);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

