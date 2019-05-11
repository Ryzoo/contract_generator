<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_breadcrumbs",
 *   title = "Breadcrumbs",
 *   description = @Translation("Create a breadcrumbs element"),
 *   group = "0",
 *   settings = {
 *     {
 *         "type" = "file",
 *         "atr_name" = "background_img",
 *         "name" = @Translation("Background image"),
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
class Breadcrumbs extends PsShortcodeBase {

    public function buildElement() {
        $theme_handler = \Drupal::service('theme_handler');
        $default_theme = $theme_handler->getDefault();
        $path = $theme_handler->getTheme($default_theme)->getPath();
        $bg_breadcrumbs = isset($this->attr['background_img']) ? $this->attr['background_img'] : '/' . $path . '/images/pattern2.jpg';
        $request = \Drupal::request();
        $route_match = \Drupal::routeMatch();
        $page_title = \Drupal::service('title_resolver')
            ->getTitle($request, $route_match->getRouteObject());
        if (is_array($page_title)) {
            $page_title = $page_title['#markup'];
        }
        $breadcrumb = \Drupal::service('breadcrumb')
            ->build($route_match)
            ->toRenderable();
        $breadcrumbs = \Drupal::service('renderer')->render($breadcrumb);
        $breadcrumbs = str_replace('<nav', '<nav class="ps-breadcrumb-nav"', $breadcrumbs);

        $html = "
                <div id='ps-breadcrumbs' style='background-image: url({$bg_breadcrumbs});'>
                    <div class='container'>
                        " . $breadcrumbs . "
                        <div class='ps-page-title'><h1>{$page_title}</h1></div>
                    </div>
                </div>";

        return $this->renderShortcode($html);
    }

    public function tips($long = FALSE) {
        return $this->createTips($long, "Long text", "Short text");
    }
}

