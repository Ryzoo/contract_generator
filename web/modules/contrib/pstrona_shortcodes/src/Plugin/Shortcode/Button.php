<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_button",
 *   title = "Button",
 *   description = @Translation("Create button."),
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "button_type",
 *         "name" = @Translation("Button type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "btn" = "Default",
 *              "btn-outline" = "Outline",
 *              "btn-texture" = "Texture"
 *         },
 *         "value" = "btn"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "button_size",
 *         "name" = @Translation("Button size"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "" = "Default",
 *              "btn-lg" = "Large",
 *              "btn-sm" = "Small",
 *         },
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "button_block",
 *         "name" = @Translation("Button width"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "" = "Default",
 *              "btn-block" = "Full width",
 *         },
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "button_color",
 *         "name" = @Translation("Button color"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "primary" = "Primary",
 *              "secondary" = "Secondary",
 *              "success" = "Success",
 *              "danger" = "Danger",
 *              "warning" = "Warning",
 *              "info" = "Info",
 *              "light" = "Light",
 *              "dark" = "Dark",
 *              "link" = "Link"
 *         },
 *         "value" = "primary"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "button_disabled",
 *         "name" = @Translation("Disabled"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "" = "Default",
 *              "ps-button-disabled" = "True",
 *              "" = "False",
 *         },
 *         "value" = ""
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "url",
 *         "name" = @Translation("Button url"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "title",
 *         "name" = @Translation("Button text"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "file",
 *         "atr_name" = "button_background",
 *         "name" = @Translation("Button background"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "icon",
 *         "atr_name" = "left_icon",
 *         "name" = @Translation("Select left button icon"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "icon",
 *         "atr_name" = "right_icon",
 *         "name" = @Translation("Select right button icon"),
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
class Button extends PsShortcodeBase
{
  public function buildElement()
  {
    $button_title = isset($this->attr['title']) ? $this->attr['title'] : 'Button title';
    $button_url = isset($this->attr['url']) ? $this->attr['url'] : '';
    $button_type = isset($this->attr['button_type']) ? $this->attr['button_type'] : 'btn-';
    $button_color = isset($this->attr['button_color']) ? $this->attr['button_color'] : 'primary';
    $button_size = isset($this->attr['button_size']) ? $this->attr['button_size'] : '';
    $button_width = isset($this->attr['button_block']) ? $this->attr['button_block'] : '';
    $button_disabled = isset($this->attr['button_disabled']) ? $this->attr['button_disabled'] : '';
    $button_icon_right = isset($this->attr['right_icon']) ? $this->attr['right_icon'] : '';
    $button_icon_left = isset($this->attr['left_icon']) ? $this->attr['left_icon'] : '';
    $dash = "-";
    $theme_handler = \Drupal::service('theme_handler');
    $default_theme = $theme_handler->getDefault();
    $path = $theme_handler->getTheme($default_theme)->getPath();
    $bg_button = isset($this->attr['button_background']) ? $this->attr['button_background'] : '/' . $path . '/images/pattern3.jpg';

    if (!($button_type == "btn-texture")) {
      $bg_button = "";
    }

    if (strlen($button_icon_right) > 0 ) {
      $button_icon_right = "<span class='ps-button-icon-right {$button_icon_right}'></span>";
    }

    if (strlen($button_icon_left) > 0 ) {
      $button_icon_left = "<span class='ps-button-icon-left {$button_icon_left}'></span>";
    }

    $return_button = "<a href='{$button_url}' type='button' style='background-image: url({$bg_button});' class='btn {$button_type} {$button_type}{$dash}{$button_color} {$button_size} {$button_width} {$button_disabled}'>{$button_icon_left}{$button_title}{$button_icon_right}</a>";

    return $this->renderShortcode($return_button);
  }

  public function tips($long = FALSE)
  {
    return $this->createTips($long, "Long text", "Short text");
  }
}

