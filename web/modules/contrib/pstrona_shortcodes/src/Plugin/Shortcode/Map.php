<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_map",
 *   title = "Google map",
 *   description = @Translation("Render a google map."),
 *   settings = {
 *     {
 *         "type" = "text",
 *         "atr_name" = "map_token",
 *         "name" = @Translation("Map token"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "object_name",
 *         "name" = @Translation("Object name on map"),
 *         "width" = "50",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "map_height",
 *         "name" = @Translation("Map height"),
 *         "width" = "25",
 *         "value" = "500"
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "map_zoom",
 *         "name" = @Translation("Map start zoom"),
 *         "width" = "25",
 *         "value" = "8"
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "map_lat",
 *         "name" = @Translation("Map lat"),
 *         "width" = "25",
 *         "value" = ""
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "map_lng",
 *         "name" = @Translation("Map lng"),
 *         "width" = "25",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Map extends PsShortcodeBase {

  public function buildElement() {

    $height = "height: " . ((isset($this->attr['map_height']) && strlen($this->attr['map_height']) >= 1) ? $this->attr['map_height'] : 500) . "px;";
    $startZoom = (isset($this->attr['map_zoom']) && strlen($this->attr['map_zoom']) >= 1) ? (int) $this->attr['map_zoom'] : 8;
    $lat = (isset($this->attr['map_lat']) && strlen($this->attr['map_lat']) >= 1) ? (float) $this->attr['map_lat'] : 52.234982;
    $lng = (isset($this->attr['map_lng']) && strlen($this->attr['map_lng']) >= 1) ? (float) $this->attr['map_lng'] : 21.008490;
    $token = (isset($this->attr['map_token']) && strlen($this->attr['map_token']) >= 1) ? $this->attr['map_token'] : 'AIzaSyDl8Psp059yiG_Q8vzI77dFkuyw5lPOR9Q';
    $objectName = (isset($this->attr['object_name']) && strlen($this->attr['object_name']) >= 1) ? $this->attr['object_name'] : "default name";

    $googleMapScript = "<script async defer src='https://maps.googleapis.com/maps/api/js?key={$token}&callback=initMap'></script>";
    $userMapScript = "
      <script>
        let map;
        function initMap() {
          let lating = {lat: {$lat}, lng: {$lng}};
          
          map = new google.maps.Map(document.getElementById('ps-google-map'), {
            center: lating,
          gestureHandling: 'cooperative',
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: {$startZoom}
          });
          
          let marker = new google.maps.Marker({
            position: lating,
            map: map,
            title: '{$objectName}'
          });
        }
      </script>";

    return $this->renderShortcode("<div id='ps-google-map' style='{$height}'></div>{$userMapScript}{$googleMapScript}");
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

