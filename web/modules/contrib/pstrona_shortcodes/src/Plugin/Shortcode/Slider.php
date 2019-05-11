<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_slider",
 *   title = "Slider",
 *   description = @Translation("Create slider container."),
 *   dependency = {
 *      "parent" = {},
 *      "child" = { "ps_slider_item" }
 *   },
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "slide_effect",
 *         "name" = @Translation("Slide effect"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "slide" = "slide",
 *              "fade" = "fade",
 *              "cube" = "cube",
 *              "coverflow" = "coverflow",
 *              "flip" = "flip"
 *         },
 *         "value" = "slide"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "slider_height",
 *         "name" = @Translation("Slider height"),
 *         "width" = "25",
 *         "value" = "500px"
 *      },
 *     {
 *         "type" = "number",
 *         "atr_name" = "slide_per_view",
 *         "name" = @Translation("Slide per view"),
 *         "width" = "25",
 *         "value" = "1"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "have_scrollbar",
 *         "name" = @Translation("Use scrollbar?"),
 *         "width" = "25",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "have_arrows",
 *         "name" = @Translation("Use nav arrows?"),
 *         "width" = "25",
 *         "value" = "false"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "have_pagination",
 *         "name" = @Translation("Show pagination dots?"),
 *         "width" = "50",
 *         "value" = "false"
 *      },
 *     {
 *         "type" = "select",
 *         "atr_name" = "slider_layout",
 *         "name" = @Translation("Slider direction"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "horizontal" = "horizontal",
 *              "vertical" = "vertical"
 *         },
 *         "value" = "horizontal"
 *      },
 *      {
 *         "type" = "checbox",
 *         "atr_name" = "is_autoplay",
 *         "name" = @Translation("Autoplay slides?"),
 *         "width" = "25",
 *         "value" = "true"
 *      },
 *      {
 *         "type" = "number",
 *         "atr_name" = "autoplay_time",
 *         "name" = @Translation("Autoplay time"),
 *         "width" = "25",
 *         "value" = "3000"
 *      },
 *   }
 * )
 */
class Slider extends PsShortcodeBase {

  public function buildElement() {

    $additionalScriptStyle = "
      <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css\">
      <script src=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js\"></script>
    ";

    $height = isset($this->attr['slider_height']) ? $this->attr['slider_height'] : "500px";
    $autoplayTime = isset($this->attr['autoplay_time']) ? $this->attr['autoplay_time'] : 3000;
    $slidePerView = isset($this->attr['slide_per_view']) ? $this->attr['slide_per_view'] : 1;

    $layout = $this->attr['slider_layout'];
    $slideEffect = $this->attr['slide_effect'];

    $isAutoplay = (isset($this->attr['is_autoplay']) && $this->attr['is_autoplay'] === "true") ? TRUE : FALSE;
    $havePaggination = (isset($this->attr['have_pagination']) && $this->attr['have_pagination'] === "true") ? TRUE : FALSE;
    $haveArrows = (isset($this->attr['have_arrows']) && $this->attr['have_arrows'] === "true") ? TRUE : FALSE;
    $haveScrollbar = (isset($this->attr['have_scrollbar']) && $this->attr['have_scrollbar'] === "true") ? TRUE : FALSE;

    $pagination = $havePaggination ? "pagination: {el: '.swiper-pagination',dynamicBullets: true,}," : "";
    $paginationTemplate = $havePaggination ? "<div class='swiper-pagination'></div>" : "";
    $arrows = $haveArrows ? "navigation: {nextEl: '.swiper-button-next',prevEl: '.swiper-button-prev',}," : "";
    $arrowsTemplate = $haveArrows ? "<div class='swiper-button-prev'></div><div class='swiper-button-next'></div>" : "";
    $scrollbar = $haveScrollbar ? "scrollbar: {el: '.swiper-scrollbar',}," : "";
    $scrollbarTemplate = $haveScrollbar ? "<div class='swiper-scrollbar'></div>" : "";
    $autoplay = $isAutoplay ? "autoplay: {delay: {$autoplayTime},disableOnInteraction: true}" : "";

    $sliderInit = "
      <script>
        let maxInit = 20;
        let init = 0;
        function initSlider(){
          if(typeof Swiper === 'undefined'){
            maxInit++;
            if(init < maxInit){
              setTimeout(function(){
                initSlider();
              },200);
            }else{
              console.error('Nie można wczytać biblioteki slidera - Swiper');
            }
          }else{
            let slider = new Swiper('.swiper-container', {
              direction: '{$layout}',
              loop: true,
              effect: '{$slideEffect}',
              slidesPerView: {$slidePerView},
              {$pagination}
              {$arrows}
              {$scrollbar}
              {$autoplay}
            })
          }
        }
        setTimeout(initSlider,500);
      </script>";

    return $this->renderShortcode("{$additionalScriptStyle}
      <div class='swiper-container' style='width: 100%; height: {$height}'>
          <div class='swiper-wrapper'>
              {$this->text}
          </div>
          {$paginationTemplate}
          {$arrowsTemplate}
          {$scrollbarTemplate}
      </div>
      {$sliderInit}
    ");
  }

  public function tips($long = FALSE) {
    return $this->createTips($long, "Long text", "Short text");
  }
}

