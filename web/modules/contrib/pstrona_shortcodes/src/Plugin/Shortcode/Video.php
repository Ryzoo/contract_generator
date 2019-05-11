<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic video shortcode
 *
 * @Shortcode(
 *   id = "ps_video",
 *   title = "Video",
 *   description = @Translation("Create video element."),
 *   settings = {
 *      {
 *         "type" = "file_list",
 *         "accept" = "video/*",
 *         "atr_name" = "video_list_src",
 *         "name" = @Translation("Select one or more video"),
 *         "width" = "100",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "video_fit",
 *         "name" = @Translation("Video fit"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "fill" = "fill",
 *              "contain" = "contain",
 *              "cover" = "cover",
 *              "none" = "none"
 *         },
 *         "value" = "cover"
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "video_position",
 *         "name" = @Translation("Video position"),
 *         "width" = "50",
 *         "select_type" = "list",
 *         "select_list" = {
 *              "center" = "center",
 *              "bottom" = "bottom",
 *              "top" = "top",
 *              "left" = "left",
 *              "right" = "right"
 *         },
 *         "value" = "center"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "video_radius",
 *         "name" = @Translation("Video border radius"),
 *         "width" = "25",
 *         "value" = "0px"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "video_width",
 *         "name" = @Translation("Video width"),
 *         "width" = "25",
 *         "value" = "100%"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "video_height",
 *         "name" = @Translation("Video height"),
 *         "width" = "25",
 *         "value" = "100%"
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "is_control",
 *         "name" = @Translation("Use video control?"),
 *         "width" = "25",
 *         "value" = "false"
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "is_autoplay",
 *         "name" = @Translation("Autoplay video?"),
 *         "width" = "25",
 *         "value" = "true"
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "is_loop",
 *         "name" = @Translation("Play video loop?"),
 *         "width" = "25",
 *         "value" = "true"
 *      },
 *     {
 *         "type" = "checbox",
 *         "atr_name" = "is_muted",
 *         "name" = @Translation("Mute Video?"),
 *         "width" = "25",
 *         "value" = "true"
 *      },
 *      {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class Video extends PsShortcodeBase {

    public function buildElement() {
        $fit = isset($this->attr['video_fit']) ? $this->attr['video_fit'] : "fill";
        $position = isset($this->attr['video_position']) ? $this->attr['video_position'] : "center";
        $width = isset($this->attr['video_width']) ? $this->attr['video_width'] : "100%";
        $height = isset($this->attr['video_height']) ? $this->attr['video_height'] : "auto";
        $radius = isset($this->attr['video_radius']) ? $this->attr['video_radius'] : "0px";
        $videoList = isset($this->attr['video_list_src']) ? $this->getUrlListFromFileListValue($this->attr['video_list_src']) : [];

        $isControl = isset($this->attr['is_control']) && $this->attr['is_control'] === "true" ? "controls" : "";
        $isAutoplay = isset($this->attr['is_autoplay']) && $this->attr['is_autoplay'] === "true" ? "autoplay" : "";
        $isMuted = isset($this->attr['is_muted']) && $this->attr['is_muted'] === "true" ? "muted" : "";
        $isLoop = isset($this->attr['is_loop']) && $this->attr['is_loop'] === "true" ? "loop" : "";


        $additionalStyle = "style='align-self: flex-start; width: {$width}; height: {$height}; object-fit: {$fit}; object-position: {$position};'";
        $returnedHtml = '';

        foreach ($videoList as $image) {
            $this->addDefStyle("display:block; height: 100%;");
            $this->addDefClass('ps-video-in');

            $returnedHtml .= $this->renderShortcode("
            <div style='display: flex; width: {$width}; margin:auto; height: {$height}; border-radius: {$radius}; overflow: hidden'>
                <video width='$width' height='$height' $isAutoplay $isMuted $isLoop $isControl $additionalStyle>
                    <source src='{$image}'>
                    Your browser does not support the video tag. Download better browser!
                </video>
            </div>", TRUE);
        }

        return $returnedHtml;
    }

    public function tips($long = FALSE) {
        return $this->createTips($long, "Long text", "Short text");
    }
}

