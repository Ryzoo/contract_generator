<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_image",
 *   title = "Image",
 *   description = @Translation("Create image."),
 *   settings = {
 *      {
 *         "type" = "file_list",
 *         "accept" = "image/*",
 *         "atr_name" = "image_list_src",
 *         "name" = @Translation("Select one or more images"),
 *         "width" = "100",
 *         "value" = ""
 *      },
 *      {
 *         "type" = "select",
 *         "atr_name" = "img_fit",
 *         "name" = @Translation("Image fit"),
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
 *         "atr_name" = "img_position",
 *         "name" = @Translation("Image position"),
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
 *         "atr_name" = "img_radius",
 *         "name" = @Translation("Image border radius"),
 *         "width" = "50",
 *         "value" = "0px"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "img_width",
 *         "name" = @Translation("Image width"),
 *         "width" = "25",
 *         "value" = "100%"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "img_height",
 *         "name" = @Translation("Image height"),
 *         "width" = "25",
 *         "value" = "100%"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "img_group",
 *         "name" = @Translation("Image group (galery etc.)"),
 *         "width" = "50",
 *         "value" = "page-default-gallery"
 *      },
 *     {
 *         "type" = "text",
 *         "atr_name" = "img_alt",
 *         "name" = @Translation("Image alt"),
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
class Image extends PsShortcodeBase {


    public function buildElement() {
        $fit = isset($this->attr['img_fit']) ? $this->attr['img_fit'] : "fill";
        $position = isset($this->attr['img_position']) ? $this->attr['img_position'] : "center";
        $width = isset($this->attr['img_width']) ? $this->attr['img_width'] : "100%";
        $height = isset($this->attr['img_height']) ? $this->attr['img_height'] : "auto";
        $radius = isset($this->attr['img_radius']) ? $this->attr['img_radius'] : "0px";
        $alt = isset($this->attr['img_alt']) ? $this->attr['img_alt'] : "";
        $imgGroup = isset($this->attr['img_group']) ? $this->attr['img_group'] : "page-default-gallery";
        $imageList = isset($this->attr['image_list_src']) ? $this->getUrlListFromFileListValue($this->attr['image_list_src']) : [];

        $additionalStyle = "style='align-self: flex-start; border-radius: {$radius}; object-fit: {$fit}; object-position: {$position}; width: {$width}; height: {$height};'";

        $returnedHtml = '';

        foreach ($imageList as $image){
            $this->addDefStyle("display:block; height: 100%;");
            $this->addDefClass('ps-image-in');
            $returnedHtml .= $this->renderShortcode("<a href='{$image}' style='display: flex;  margin:auto; width: {$width}; height: {$height};' data-fancybox='{$imgGroup}' data-caption='{$alt}'><img {$additionalStyle} alt='{$alt}' src='{$image}'/></a>", TRUE);
        }

        return $returnedHtml;
    }

    public function tips($long = FALSE) {
        return $this->createTips($long, "Long text", "Short text");
    }
}

