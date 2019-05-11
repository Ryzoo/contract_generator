<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_banner",
 *   title = "Banner",
 *   description = @Translation("Create a hover animated banner."),
 *   settings = {
 *     {
 *         "type" = "file",
 *         "atr_name" = "background_img",
 *         "name" = @Translation("Background image"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "select",
 *         "atr_name" = "banner_type",
 *         "name" = @Translation("Banner type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "v1" = "Banner default version",
 *              "v2" = "Banner version 2",
 *              "v3" = "Banner version 3"
 *         },
 *         "value" = "v1"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "title",
 *         "name" = @Translation("Banner title"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "textarea",
 *         "atr_name" = "description",
 *         "name" = @Translation("Banner description"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Banner extends PsShortcodeBase
{
    public function buildElement()
    {
        $theme_handler = \Drupal::service('theme_handler');
        $default_theme = $theme_handler->getDefault();
        $path = $theme_handler->getTheme($default_theme)->getPath();
        $bg_banner = isset($this->attr['background_img']) ? $this->attr['background_img'] : '/' . $path . '/images/pattern2.jpg';
        $title_banner = isset($this->attr['title']) ? $this->attr['title'] : 'Title';
        $description_banner = isset($this->attr['description']) ? $this->attr['description'] : 'Description of this amazing banner by positive website.';
        $banner_type = isset($this->attr['banner_type']) ? $this->attr['banner_type'] : 'v1';
        $return_banner = "";

        switch ($banner_type) {
            case "v1":
                $return_banner = "
            <div class='ps-banner ps-banner-v1'>
                <div class='ps-banner-image'>
                    <img src='{$bg_banner}'/>
                </div>
                <div class='ps-banner-text-container'>
                    <div class='ps-banner-text'>
                        <h3>{$title_banner}</h3>
                        <p>{$description_banner}</p>
                    </div>
                </div>
            </div>";
                break;
            case "v2":
                $return_banner = "
            <div class='ps-banner ps-banner-v2'>
                <div class='ps-banner-image'>
                    <img src='{$bg_banner}'/>
                </div>
                <div class='ps-banner-text-container'>
                    <div class='ps-banner-text'>
                        <h3>{$title_banner}</h3>
                        <p>{$description_banner}</p>
                    </div>
                </div>
            </div>";
                break;
            case "v3":
                $return_banner = "
            <div class='ps-banner ps-banner-v3'>
                <div class='ps-banner-image'>
                    <img src='{$bg_banner}'/>
                </div>
                <div class='ps-banner-text-container'>
                    <div class='ps-banner-text'>
                        <h3>{$title_banner}</h3>
                        <p>{$description_banner}</p>
                    </div>
                </div>
            </div>";
                break;
        }

        return $this->renderShortcode($return_banner,true);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}

