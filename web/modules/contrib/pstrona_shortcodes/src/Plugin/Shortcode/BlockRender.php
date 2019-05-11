<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;
use \Drupal\views\Views;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_blockrender",
 *   title = "Block",
 *   description = @Translation("Render selected block"),
 *   group = "2",
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "block_name",
 *         "name" = @Translation("Blok"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "block",
 *         "value" = "default"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class BlockRender extends PsShortcodeBase
{

  public function buildElement()
  {

//    $allBlocks = \Drupal\block\Entity\Block::loadMultiple();
//
//    foreach ($allBlocks as $bid => $value) {
//      kint($value->getPluginId());
//      kint($bid);
//    }

    $blockName = isset($this->attr['block_name']) ? $this->attr['block_name'] : false;
    if ($blockName)  {
      $block = \Drupal\block\Entity\Block::load($blockName);
      $block_content = \Drupal::entityManager()->getViewBuilder('block')->view($block);
      $renderBlock = \Drupal::service('renderer')->renderRoot($block_content);
    } else {
      $renderBlock = "";
    }


    return $this->renderShortcode($renderBlock);
  }

  public function tips($long = false)
  {
    return $this->createTips($long, "Long text", "Short text");
  }
}
