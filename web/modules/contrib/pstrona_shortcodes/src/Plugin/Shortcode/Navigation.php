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
 *   id = "ps_navigation",
 *   title = "Main navigation",
 *   description = @Translation("Create a main page navigation"),
 *   group = "0",
 *   settings = {
 *      {
 *         "type" = "select",
 *         "atr_name" = "name",
 *         "name" = @Translation("Menu type"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *             "default" = "Domyślny"
 *         },
 *         "value" = "default"
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
 *         "type" = "file",
 *         "atr_name" = "logo_img",
 *         "name" = @Translation("Navigation logo"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "search_box",
 *         "name" = @Translation("Wyszukiwarka w nawigacji"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "small_nav",
 *         "name" = @Translation("Mniejsza nawigacja"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *     {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Navigation extends PsShortcodeBase
{
    public function getSearchForm() {
        $form = \Drupal::formBuilder()->getForm(SearchBlockForm::class);
        $form['keys']['#attributes']['placeholder'] = t('Wpisz szukaną frazę...');
        $form['actions']['#attributes']['class'][0] .= ' ps-hide';
        $render = render($form);
        $render = str_replace('</form>', '<button type="reset" class="search ps-search-button"></button></form>', $render);
        $render = str_replace('class="form-search"', 'class="form-search ps-input-search"', $render);
        return $this->renderShortcode($render);
    }

    public function buildElement()
    {
      $theme_handler = \Drupal::service('theme_handler');
      $default_theme = $theme_handler->getDefault();
      $path = $theme_handler->getTheme($default_theme)->getPath();
      $navigation_logo = isset($this->attr['logo_img']) ? $this->getUrlFromFile($this->attr['logo_img']) : '/' . $path . '/images/kinderworld.png';
      $links = (isset($this->attr['navigation']) && strlen($this->attr['navigation']) > 2) ? $this->getMenu($this->attr['navigation'], true, true) : $this->getMenu('main', true, true);
      $search_block = (isset($this->attr['search_box']) && $this->attr['search_box'] === 'true') ? '<li type="search"><div>'.$this->getSearchForm().'</div></li>' : "";
      $smaller_nav = (isset($this->attr['small_nav']) && $this->attr['small_nav'] === 'true') ? "ps-navigation-small" : "";

      $render_navigation = "
              <div id='ps-main-navigation' class='{$smaller_nav}'>
                  <div class='container'>
                      <div class='ps-menu-logo'>
                          <a href='/'><img src='{$navigation_logo}'/></a>
                      </div>
                      <div class='ps-menu-links'>
                          <nav class='ps-menu-nav'>
                              <ul class='ps-nav ps-unstyled-list'>{$links}{$search_block}</ul>
                          </nav>
                          <div class='hamburger hamburger--squeeze' type='button'>
                            <span class='hamburger-box'>
                              <span class='hamburger-inner'></span>
                            </span>
                          </div>
                      </div>
                  </div>
              </div>";

      return $this->renderShortcode($render_navigation);
    }

    public function tips($long = FALSE)
    {
        return $this->createTips($long, "Long text", "Short text");
    }
}
