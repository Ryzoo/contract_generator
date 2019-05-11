<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\Core\Language\Language;
use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;
use Drupal\search\Form\SearchBlockForm;
use Drupal\Core\Block\BlockBase;
use Drupal\block\BlockRepository;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_menu",
 *   title = "Menu",
 *   description = @Translation("Create menu"),
 *   group = "2",
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "menu",
 *         "name" = @Translation("Menu"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "menu",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */

class Menu extends PsShortcodeBase
{

  public function buildElement()
  {

    $menu = isset($this->attr['menu']) ? $this->getMenu($this->attr['menu'], true,false) : $this->getMenu('main', true, false);

    $render_menu = "{$menu}";

    return $this->renderShortcode($render_menu);
  }

  public function tips($long = FALSE)
  {
    return $this->createTips($long, "Long text", "Short text");
  }
}
