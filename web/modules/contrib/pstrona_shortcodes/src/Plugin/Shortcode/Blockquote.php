<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_quote",
 *   title = "Quote",
 *   description = @Translation("Create blockquote."),
 *   settings = {
 *     {
 *         "type" = "textarea",
 *         "atr_name" = "quote_desc",
 *         "name" = @Translation("Quote"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "quote_author",
 *         "name" = @Translation("Quote author"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "quote_source",
 *         "name" = @Translation("Quote source title"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Blockquote extends PsShortcodeBase
{

    public function buildElement()
    {
//        $quote_type = isset($this->attr['quote_type']) ? $this->attr['quote_type'] : 'v1';
        $quote_desc = isset($this->attr['quote_desc']) ? $this->attr['quote_desc'] : 'Edit it and insert quote';
        $quote_author = isset($this->attr['quote_author']) ? $this->attr['quote_author'] : '';
        $quote_source = isset($this->attr['quote_source']) ? $this->attr['quote_source'] : '';
        $addFooter = strlen($quote_author) > 0 || strlen($quote_source) > 0;

        $footer = $addFooter ? "<footer>
                                    <div class='ps-quote-author'> {$quote_author}</div><cite title='{$quote_source}'>, {$quote_source}</cite> 
                                </footer>" : "";

//        $return_quote = "";
//        switch ($quote_type) {
//            case "v1":
                $return_quote = "
                    <blockquote>
                        <i class='fas fa-quote-right'></i>
                        <p>{$quote_desc}</p>
                        {$footer}
                    </blockquote>
                ";
//                break;
//        }


        return $this->renderShortcode($return_quote);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

