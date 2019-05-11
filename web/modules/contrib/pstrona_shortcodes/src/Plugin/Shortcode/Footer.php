<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_footer",
 *   title = "Footer",
 *   description = @Translation("Create a page footer"),
 *   group = "0",
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "name",
 *         "name" = @Translation("Footer type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "default" = "Domyślny"
 *         },
 *         "value" = "default"
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "copyright",
 *         "name" = @Translation("Tekst copyright"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "navigation",
 *         "name" = @Translation("Main menu"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "menu",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "footer_navigation",
 *         "name" = @Translation("Footer menu"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "menu",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "file",
 *         "atr_name" = "background_img",
 *         "name" = @Translation("Background image"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "file",
 *         "atr_name" = "logo_img",
 *         "name" = @Translation("Footer logo"),
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
class Footer extends PsShortcodeBase
{
    public function getMenuFooter($name, $break)
    {
        $links = "";
        $breakpoint = $break;
        $menu_tree = \Drupal::menuTree();
        $menu_name = $name;
        $parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
        $tree = $menu_tree->load($menu_name, $parameters);
        $manipulators = array(
            array('callable' => 'menu.default_tree_manipulators:checkAccess'),
            array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
        );
        $tree = $menu_tree->transform($tree, $manipulators);
        $menu_tmp = $menu_tree->build($tree);

        $menu = array();
        if(array_key_exists('#items', $menu_tmp)){
          foreach ($menu_tmp['#items'] as $item) {
            if ($item['url']->getRouteName() == 'front') {
              $menu[] = [$item['title'] => $item['url']->getRouteName()];
            } elseif ($item['url']->getRouteName() == 'entity.node.canonical') {
              $node = [$item['title'] => $item['url']->getRouteParameters()];
              $node = $node[$item['title']];
              $node_alias = '';
              foreach ($node as $key => $node_number) {
                $path = '/node/' . (int) $node_number;
                $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
                $node_alias = \Drupal::service('path.alias_manager')->getAliasByPath($path, $langcode);
              }
              $menu[] = [$item['title'] => trim($node_alias, '/')];
            } else {
              $menu[] = [$item['title'] => $item['url']->getInternalPath()];
            }
          }
          $i = 1;

          foreach ($menu as $key => $menu_item) {
            foreach ($menu_item as $name => $url) {
              if (!($i == count($menu_item))) {
                $links .= "<li><a href='/{$url}'>{$name}</a></li>{$breakpoint}";
                $i++;
              } else {
                $links .= "<li><a href='/{$url}'>{$name}</a></li>";
              }
            }
          }
        } else {
          $links = "";
        }

        return $this->renderShortcode($links);
    }

    public function buildElement()
    {
      $theme_handler = \Drupal::service('theme_handler');
      $default_theme = $theme_handler->getDefault();
      $path = $theme_handler->getTheme($default_theme)->getPath();
        $bg_footer = isset($this->attr['background_img']) ? $this->getUrlFromFile($this->attr['background_img']) : '/'.$path.'/images/pattern3.jpg';
        $footer_logo = isset($this->attr['logo_img']) ? $this->getUrlFromFile($this->attr['logo_img']) : '/'.$path.'/images/KinderWorldLogoFooter.png';
        $copyright = isset($this->attr['copyright']) ? $this->attr['copyright'] : '2018 Copyright <a href="#">KinderWorldD8</a> by <a href="//mywebthemes.com">myWebThemes.com</a>. All rights reserved.';
        $links = (isset($this->attr['navigation'])  && strlen($this->attr['navigation']) > 2) ? $this->getMenu($this->attr['navigation'], '',false) : $this->getMenu('main', false, false);
        $footer_links = (isset($this->attr['footer_navigation']) && strlen($this->attr['footer_navigation']) > 2) ? $this->getMenuFooter($this->attr['footer_navigation'], '') : $this->getMenuFooter('footer', '|');

        $render_footer = "
                <div id='ps-footer-with-menu' style='background-image: url({$bg_footer});'>
                    <div class='container'>
                        <div class='ps-footer-logo'>
                            <img src='{$footer_logo}'/>
                        </div>
                        <div class='ps-menu-links'>
                            <ul class='ps-nav ps-unstyled-list'>".$links."</ul>
                        </div>
                    </div>
                </div>
                <div id='ps-postfooter'>
                    <div class='container'>
                        <div class='ps-copyright'><p>{$copyright}</p></div>
                        <div class='ps-footer-links'>
                            <ul class='ps-nav ps-unstyled-list'>".$footer_links."</ul>
                        </div>
                    </div>
                </div>";

        return $this->renderShortcode($render_footer);
    }

    public function tips($long = false)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}
