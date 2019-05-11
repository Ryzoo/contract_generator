<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_html",
 *   title = "HTML content",
 *   description = @Translation("Create element with html content in"),
 *   group = "1",
 *   settings = {
 *      {
 *         "type" = "html",
 *         "atr_name" = "html_content",
 *         "name" = @Translation("Zawartość html"),
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
class HtmlContent extends PsShortcodeBase
{
    public function buildElement()
    {
        $render = '';

        if(isset($this->attr['html_content'])){
            $render = $this->attr['html_content'];
        }

        $this->addDefClass('ps-html-content');

        return $this->renderShortcode($render);
    }

    public function tips($long = false)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}
