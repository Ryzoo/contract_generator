<?php

namespace Drupal\pstrona_shortcodes\Plugin\Editor;

use Drupal\editor\Plugin\EditorBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines a text editor for Drupal.
 *
 * @Editor(
 *   id = "ps_shortcode_editor",
 *   label = @Translation("Edytor do shortcodów"),
 *   supports_content_filtering = FALSE,
 *   supports_inline_editing = FALSE,
 *   is_xss_safe = FALSE,
 *   supported_element_types = {
 *     "textarea"
 *   }
 * )
 */
class PSShortcodeEditor extends EditorBase {

  /**
   * {@inheritdoc}
   */
  public function getJSSettings (Editor $editor) {
    return [];
  }
	
  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    $libs = [
      'pstrona_shortcodes/shortcode_editor'
    ];
    return $libs;
  }

}