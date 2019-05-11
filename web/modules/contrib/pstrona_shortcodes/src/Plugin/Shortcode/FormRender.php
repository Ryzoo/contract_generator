<?php

namespace Drupal\pstrona_shortcodes\Plugin\Shortcode;

use Drupal\pstrona_shortcodes\AdditionalClass\PsShortcodeBase;

/**
 * Provides a basic button shortcode
 *
 * @Shortcode(
 *   id = "ps_formrender",
 *   title = "Form",
 *   description = @Translation("Render selected form"),
 *   group = "2",
 *   settings = {
 *     {
 *         "type" = "select",
 *         "atr_name" = "form_name",
 *         "name" = @Translation("Form"),
 *         "width" = "50",
 *         "select_type" = "server",
 *         "select_server" = "form",
 *         "value" = "default"
 *      },
 *     {
 *         "type" = "solo",
 *         "value" = "true"
 *      }
 *   }
 * )
 */
class FormRender extends PsShortcodeBase {

    public function buildElement() {
        if (empty($this->attr['form_name'])) {
            $render = t('Brak wybranego formularza.');
        }
        else {
            $name = $this->attr['form_name'];
            $webform = \Drupal\webform\Entity\Webform::load($name);
            $build = \Drupal::entityTypeManager()
                ->getViewBuilder('webform')
                ->view($webform);
            $render = render($build);
        }


        return $this->renderShortcode($render);
    }

    public function tips($long = FALSE) {
        return $this->createTips($long, "Long text", "Short text");
    }
}
