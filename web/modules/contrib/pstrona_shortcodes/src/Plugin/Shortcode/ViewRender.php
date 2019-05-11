<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;
use \Drupal\views\Views;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_viewrender",
 *   title = "View",
 *   description = @Translation("Render selected view"),
 *   group = "2",
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "view_name",
 *         "name" = @Translation("Widok"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "view",
 *         "value" = "default"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class ViewRender extends PsShortcodeBase {

  public function buildElement() {
    $viewName = isset($this->attr['view_name']) ? $this->attr['view_name'] : FALSE;
    $renderView = "";

    if ($viewName) {
      $id = explode(':', $viewName)[0];
      $display = isset(explode(':', $viewName)[1]) ? explode(':', $viewName)[1] : NULL;

      $view = Views::getView($id);
      if (!is_null($display)) {
        $view->setDisplay($display);
        $view->preExecute();
        $view->execute();
      }
      $view = $view->buildRenderable();
      $renderView = \Drupal::service('renderer')->renderRoot($view);
    }

    return $this->renderShortcode($renderView);
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}
