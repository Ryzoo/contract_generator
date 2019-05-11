<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_accordion",
 *   title = "Accordion item",
 *   description = @Translation("Create accordion item."),
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "accordion_type",
 *         "name" = @Translation("Accordion type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "v1" = "Accordion default version",
 *              "v2" = "Accordion version 2",
 *              "v3" = "Accordion version 3",
 *         },
 *         "value" = "v1"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "title",
 *         "name" = @Translation("Accordion title"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *   }
 * )
 */
class Accordions extends PsShortcodeBase
{
    public function buildElement()
    {
        $accordion_title = isset($this->attr['title']) ? $this->attr['title'] : 'Accordion title';
        $accordion_type = isset($this->attr['accordion_type']) ? $this->attr['accordion_type'] : 'v1';
        $return_accordion = "";

        switch ($accordion_type) {
            case "v1":
                $return_accordion = "
            <div class='ps-accordion ps-accordion-v1'>
                <h4><i class='fas fa-chevron-right'></i>{$accordion_title}</h4>
                <div class='ps-accordion-text'>
                    {$this->text}
                </div>
            </div>";
                break;
            case "v2":
                $return_accordion = "
            <div class='ps-accordion ps-accordion-v2'>
                <h4><i class='fas fa-chevron-right'></i>{$accordion_title}</h4>
                <div class='ps-accordion-text'>
                    {$this->text}
                </div>
            </div>";
                break;
            case "v3":
                $return_accordion = "
            <div class='ps-accordion ps-accordion-v3'>
                <h4><i class='fas fa-chevron-right'></i>{$accordion_title}</h4>
                <div class='ps-accordion-text'>
                    {$this->text}
                </div>
            </div>";
                break;
        }

        return $this->renderShortcode($return_accordion, true);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

