<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_topbar",
 *   title = "Topbar",
 *   description = @Translation("Create a page topbar"),
 *   group = "0",
 *   settings = {
 *      {
 *         "type" = "text",
 *         "atr_name" = "fb_link",
 *         "name" = @Translation("Link facebook"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "twitter_link",
 *         "name" = @Translation("Link twitter"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "tel",
 *         "name" = @Translation("Telefon kontaktowy"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "text",
 *         "atr_name" = "email",
 *         "name" = @Translation("Email kontaktowy"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_register",
 *         "name" = @Translation("Wyświetlić przycisk logowania?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_language",
 *         "name" = @Translation("Wyświetlić wybór języka?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Topbar extends PsShortcodeBase  {

  public function buildElement(){

      $html = '';

      if(isset($this->attr['is_language']) && $this->attr['is_language'] === 'true'){
          $html .= $this->buildLanguageSelectorElement();
      }

      if(isset($this->attr['is_register']) && $this->attr['is_register'] === 'true'){
          $html .= $this->buildLoginRegisterButton();
      }

      if(isset($this->attr['fb_link']) && strlen($this->attr['fb_link']) > 0){
          $html .= $this->getSocialCode('fb',$this->attr['fb_link']);
      }

      if(isset($this->attr['twitter_link'] )&& strlen($this->attr['twitter_link']) > 0){
          $html .= $this->getSocialCode('twitter',$this->attr['twitter_link']);
      }

      if(isset($this->attr['tel']) && strlen($this->attr['tel']) > 0){
          $html .= $this->getContactCode('phone',$this->attr['tel']);
      }

      if(isset($this->attr['email']) && strlen($this->attr['email']) > 0){
          $html .= $this->getContactCode('mail',$this->attr['email']);
      }

      $html = "
      <div class='topbar-container'>
          <div class='container'>
              <div class='row'>
                  <section class='col-sm'>
                      <div class='region-topbar'>{$html}</div>
                  </section>
              </div>
          </div>
      </div>";

      return $this->renderShortcode($html);
  }

  public function buildLanguageSelectorElement()
  {
      $langs = \Drupal::languageManager()->getLanguages();
      $current = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $flag = "flag flag-" . $current;
      $flag = "<span class='" . $flag . "'></span>";
      $code = " <div class='lang-selector'> <span>" . $flag . t(\Drupal::languageManager()->getLanguageName($current)) . "</span><ul>";
      $current_path = \Drupal::request()->getRequestUri();

      foreach ($langs as $key => $lang) {
          if($current !== $key){
              $flag = "flag flag-" . $key;
              $flag = "<span class='" . $flag . "'></span>";
              $code .= "<li class='{$key}'><a href='{$current_path}?language={$key}'>" . $flag . t(\Drupal::languageManager()->getLanguageName($key)) . "</a></li>";
          }
      }

      if(count($langs) == 1){
          $code .= "<li class='no-lang'>Brak dostępnych języków</li>";
      }

      $code .= "</ul></div>";

      return $code;
  }

  public function buildLoginRegisterButton(){
      $currentStatus = (\Drupal::currentUser()->isAnonymous()) ? "logout" : "loged";
      $href = '';
      $text = '';
      $icon = '';

      switch ($currentStatus){
          case "logout":
              $href = '/user';
              $text = t('Zaloguj / Zarejestruj');
              $icon = 'fas fa-user-lock';
              break;
          case "loged":
              $href = '/user/logout';
              $text = t('Wyloguj');
              $icon = 'fas fa-sign-out-alt';
              break;
      }

      return "<a href='{$href}'><i class='{$icon}'></i><span>{$text}</span></a>";
  }

  public function getContactCode( $type, $content ){
      $icon = 'zly typ';
      $href = 'zly typ';

      switch($type){
          case 'phone':
              $icon = 'fas fa-phone';
              $href = 'tel:';
              break;
          case 'mail':
              $icon = 'fas fa-envelope';
              $href = 'mailto:';
              break;
      }

      $href .= $content;

      return "<a class='contact-element' href='{$href}'><i class='{$icon}'></i><span>".$content."</span></a>";
  }

  public function getSocialCode( $type, $link ){
      $icon = 'zly typ';

      switch($type){
          case 'fb':
              $icon = 'fab fa-facebook-f';
              break;
          case 'twitter':
              $icon = 'fab fa-twitter';
              break;
          case 'gplus':
              $icon = 'fab fa-google-plus-g';
              break;
          case 'youtube':
              $icon = 'fab fa-youtube';
              break;
          case 'linkedin':
              $icon = 'fab fa-linkedin';
              break;
          case 'skype':
              $icon = 'fab fa-skype';
              break;
          case 'rss':
              $icon = 'fas fa-rss';
          break;
      }

      return "<a class='social-icon' href='{$link}'><i class='{$icon}'></i></a>";
  }

  public function tips($long = FALSE) {
      return $this->createTips($long, "Long text", "Short text");
  }
}
