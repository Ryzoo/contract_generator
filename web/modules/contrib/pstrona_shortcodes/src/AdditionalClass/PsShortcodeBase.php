<?php

namespace Drupal\pstrona_shortcodes\AdditionalClass;

use Drupal\Core\Language\Language;
use Drupal\shortcode\Plugin\ShortcodeBase;
use Drupal\Core\Menu\MenuTreeParameters;

abstract class PsShortcodeBase extends ShortcodeBase {

    protected $attr;

    protected $text;

    public function getUrlFromFile($file) {
        $url = explode("{#}", $file);
        return isset($url[1]) ? $url[1] : 'error with this url';
    }

    public function getUrlListFromFileListValue(?string $fileListValue): array {
        if (!isset($fileListValue) || is_null($fileListValue)) {
            return [];
        }

        $returnedArray = [];
        $listOfUrl = explode("{|#|}", $fileListValue);

        foreach ($listOfUrl as $url) {
            if(strlen($url) > 3){
                $returnedArray[] = $this->getUrlFromFile($url);
            }
        }

        return $returnedArray;
    }

    abstract protected function buildElement();

    public function process(array $attributes, $text, $langcode = Language::LANGCODE_NOT_SPECIFIED) {
        $this->attr = array_filter($this->extendDefaultAttributes($attributes));
        $this->text = $text;
        return $this->buildElement();
    }

    protected function renderShortcode($shortcodeHtml, $full = FALSE, $addRenderClass = TRUE) {
        $container = '';
        $animationData = '';

        if (!isset($this->attr['style'])) {
            $this->attr['style'] = "";
        }

        $shadow = (isset($this->attr['is_shadow']) && $this->attr['is_shadow'] === 'true') ? TRUE : FALSE;
        if ($shadow) {
            $this->addDefStyle("filter: drop-shadow(5px 4px 3px #00000061);");
        }

        if (isset($this->attr['animation_name']) && strlen($this->attr['animation_name']) > 0 && $this->attr['animation_name'] !== "none") {
            $this->addDefClass("wow " . $this->attr['animation_name']);

            if (isset($this->attr['animation_delay']) && strlen($this->attr['animation_delay']) > 0) {
                $delay = ((int) $this->attr['animation_delay']) / 1000.0;
                $animationData = "data-wow-delay=\"{$delay}s\"";
            }

            if (isset($this->attr['animation_duration']) && strlen($this->attr['animation_duration']) > 0) {
                $duration = ((int) $this->attr['animation_duration']) / 1000.0;
                $animationData .= " data-wow-duration=\"{$duration}s\"";
            }
        }

        if (isset($this->attr['hover_class']) && strlen($this->attr['hover_class']) > 0) {
            $this->addDefClass($this->attr['hover_class']);
        }

        if (isset($this->attr['id']) && strlen($this->attr['id']) > 0) {
            $this->attr['id'] = trim($this->attr['id']);
            $this->attr['id'] = str_replace(" ", "_", $this->attr['id']);
            $this->attr['id'] = str_replace("\"", "", $this->attr['id']);
            $this->attr['id'] = str_replace("'", "", $this->attr['id']);
            $this->attr['id'] = 'id="' . $this->attr['id'] . '"';
        }
        else {
            $this->attr['id'] = '';
        }

        $renderClass = $addRenderClass ? "ps-shortcode-render-container" : "";

        if (isset($this->attr['class']) && strlen($this->attr['class']) > 0) {
            $this->attr['class'] = trim($this->attr['class']);
            $this->attr['class'] = str_replace("  ", " ", $this->attr['class']);
            $this->attr['class'] = str_replace("\"", "", $this->attr['class']);
            $this->attr['class'] = str_replace("'", "", $this->attr['class']);
            $this->attr['class'] = 'class="' . $renderClass . ' ' . $this->attr['class'] . '"';
        }
        else {
            $this->attr['class'] = 'class="' . $renderClass . '"';
        }

        if ($full) {
            $this->attr['style'] = (isset($this->attr['style']) ? $this->attr['style'] . " " : "") . "width: 100%";
        }

        if (isset($this->attr['style'])) {
            $this->attr['style'] = trim($this->attr['style']);
            $this->attr['style'] = str_replace("\"", "", $this->attr['style']);
            $this->attr['style'] = str_replace("'", "", $this->attr['style']);

            if (isset($this->attr['additional_styles']) && strlen($this->attr['additional_styles']) > 0) {
                $this->attr['additional_styles'] = trim($this->attr['additional_styles']);
                $this->attr['additional_styles'] = str_replace("\"", "", $this->attr['additional_styles']);
                $this->attr['additional_styles'] = str_replace("'", "", $this->attr['additional_styles']);

                if (substr($this->attr['style'], -1) !== ";") {
                    $this->attr['style'] .= ";";
                }

                $this->attr['style'] .= $this->attr['additional_styles'];
            }

            $this->attr['style'] = 'style="' . $this->attr['style'] . '"';
        }

        $container .= "<div {$this->attr['id']} {$this->attr['class']} {$this->attr['style']} {$animationData}>";
        $container .= $shortcodeHtml;
        $container .= '</div>';

        $this->attr['id'] = null;
        $this->attr['style'] = null;
        $this->attr['class'] = null;
        return $container;
    }

    protected function extendDefaultAttributes($attributes) {
        if (!is_array($attributes)) {
            $attributes = [];
        }

        $defaults = [
            'id' => '',
            'class' => '',
            'style' => '',
        ];

        foreach ($defaults as $name => $default) {
            if (!array_key_exists($name, $attributes)) {
                $attributes[$name] = $default;
            }
        }

        if (!is_array($attributes['class']) && strlen($attributes['class']) <= 0) {
            $attributes['class'] = [];
        }

        return $attributes;
    }

    protected function addDefClass($def) {
        if (!isset($this->attr['class']) || $this->attr['class'] == NULL) {
            $this->attr['class'] = '';
        }

        $this->attr['class'] .= " " . $def;
    }

    protected function addDefStyle($style) {
        if (!isset($this->attr['style']) || $this->attr['style'] == NULL || $this->attr['style'] === '') {
            $this->attr['style'] = '';
            $this->attr['style'] .= " " . $style;
        }
        else {
            $last = substr(trim($this->attr['style']), -1);
            if ($last === ';') {
                $this->attr['style'] .= " " . $style;
            }
            else {
                $this->attr['style'] .= "; " . $style;
            }
        }
    }

    protected function createTips($long, $longText, $shortText) {
        $output = [];
        $output[] = '<p>';

        if ($long) {
            $output[] = $this->t($longText) . '</p>';
        }
        else {
            $output[] = $this->t($shortText) . '</p>';
        }

        return implode(' ', $output);
    }

    protected function strip_tags_content($text, $tags = '', $invert = FALSE) {

        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);

        if (is_array($tags) AND count($tags) > 0) {
            if ($invert == FALSE) {
                return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            }
            else {
                return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
            }
        }
        elseif ($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

    protected function getMenu($name, $dropdown = FALSE, $styled) {
        $active = "";
        $links = "";
        $dropdownMenu = "";
        $menu_tree = \Drupal::menuTree();
        $menu_name = $name;
        $parameters = new MenuTreeParameters();
        $parameters->onlyEnabledLinks();
        $tree = $menu_tree->load($menu_name, $parameters);
        $manipulators = [
            ['callable' => 'menu.default_tree_manipulators:checkAccess'],
            ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
        ];
        $tree = $menu_tree->transform($tree, $manipulators);
        $menu_tmp = $menu_tree->build($tree);
        $menu = [];

        if (isset($menu_tmp['#items'])) {
            foreach ($menu_tmp['#items'] as $item) {
                if ($item['url']->isRouted()) {
                    if ($item['url']->getRouteName() == 'front') {
                        $menu_item = [
                            "url" => '/' . $item['url']->getRouteName(),
                            "name" => $item['title'],
                        ];
                    }
                    elseif ($item['url']->getRouteName() == 'entity.node.canonical') {
                        $node = [$item['title'] => $item['url']->getRouteParameters()];
                        $node = $node[$item['title']];
                        $node_alias = '';
                        foreach ($node as $key => $node_number) {
                            $path = '/node/' . (int) $node_number;
                            $langcode = \Drupal::languageManager()
                                ->getCurrentLanguage()
                                ->getId();
                            $node_alias = \Drupal::service('path.alias_manager')
                                ->getAliasByPath($path, $langcode);
                        }
                        $menu_item = [
                            "url" => $node_alias,
                            "name" => $item['title'],
                        ];
                    }
                    else {
                        $menu_item = [
                            "url" => '/' . $item['url']->getInternalPath(),
                            "name" => $item['title'],
                        ];
                    }
                } elseif ($item['url']->isExternal()) {
                    $menu_item = [
                        "url" => $item['url']->getUri(),
                        "name" => $item['title'],
                    ];
                } else {
                    $menu_item = [
                        "url" => str_replace('base:', '', '/' . $item['url']->toUriString()),
                        "name" => $item['title'],
                    ];
                }

                if ($dropdown) {
                    if (is_array($item['below']) && !empty($item['below'])) {
                        if ($styled) {
                            $dropdownMenu .= $this->getDropdownMenu($item['below'], 1, TRUE);

                        }
                        else {
                            $dropdownMenu .= $this->getDropdownMenu($item['below'], 1, FALSE);
                        }
                        $menu_item['dropdown'] = $dropdownMenu;
                        $dropdownMenu = "";
                    }
                }

                $menu[] = $menu_item;
            }
        }


        $result = $this->getActiveClass();
        $first = FALSE;

        foreach ($menu as $key => $menu_item) {
            $dropdownMenu = isset($menu_item["dropdown"]) ? $menu_item["dropdown"] : "";
            if ($result && !$first) {
                if ($menu_item['url'] == trim($result, "/") || $menu_item['name'] == $result) {
                    $active = "class='ps-active'";
                    $first = TRUE;
                }
            }
            if ($styled) {
                $links .= "<li {$active}><a href='{$menu_item['url']}'>{$menu_item['name']}</a>{$dropdownMenu}</li>";
            }
            else {
                $links .= "<li><a href='{$menu_item['url']}'>{$menu_item['name']}</a>{$dropdownMenu}</li>";
            }
            $active = "";
        }

        return $links;
    }

    protected function getDropdownMenu($dropdown, $level, $styled) {
        if ($level > 1) {
            if ($styled) {
                $content = "<ul class='ps-dropdown'>";
            }
            else {
                $content = "<ul>";
            }
        }
        else {
            if ($styled) {
                $content = "<i class='fas fa-caret-down'></i><ul class='ps-dropdown'>";
            }
            else {
                $content = "<ul>";
            }
        }
        $content_below = "";
        $node_alias = "";
        foreach ($dropdown as $item) {
            $title = $item['title'];
            if ($item['url']->isRouted() && $item['url']->getRouteName() == 'entity.node.canonical') {
                $node = [$item['title'] => $item['url']->getRouteParameters()];
                $node = $node[$item['title']];
                $node_alias = '';
                foreach ($node as $key => $node_number) {
                    $path = '/node/' . (int) $node_number;
                    $langcode = \Drupal::languageManager()
                        ->getCurrentLanguage()
                        ->getId();
                    $node_alias = \Drupal::service('path.alias_manager')
                        ->getAliasByPath($path, $langcode);
                }
            } elseif ($item['url']->isExternal()) {
                $node_alias = $item['url']->getUri();
            } elseif ($item['url']->getRouteName() == '<front>') {
                $node_alias = '/';
            } else {
                $node_alias = str_replace('base:', '', $item['url']->toUriString());
            }
            $url = $node_alias;

            $right_arrow = "";
            if (is_array($item['below']) && !empty($item['below'])) {
                $content_below .= $this->getDropdownMenu($item['below'], 2, $styled);
                $right_arrow = "<i class='fas fa-caret-right'></i>";
            }

            if ($styled) {
                $content .= "<li><a href='{$url}'>{$title}</a>{$right_arrow}{$content_below}</li>";
            }
            else {
                $content .= "<li><a href='{$url}'>{$title}</a>{$content_below}</li>";
            }
            $content_below = "";

        }

        $content .= "</ul>";
        return $content;
    }

    protected function getActiveClass() {
        if (\Drupal::service('path.matcher')->isFrontPage()) {
            return "/";
        }
        else {
            $node_id = "";
            $node = \Drupal::routeMatch()->getParameter('node');
            if ($node instanceof \Drupal\node\NodeInterface) {
                $node_id = $node->id();
            }
            $menu_link_manager = \Drupal::service('plugin.manager.menu.link');
            $result = $menu_link_manager->loadLinksByRoute('entity.node.canonical', ['node' => $node_id]);
            if (empty($result)) {
                return FALSE;
            }
            foreach ($result as $key => $child) {
                $currentPluginId = $child->getPluginId();
                $getParents = $menu_link_manager->getParentIds($currentPluginId);
                $parent = array_reverse($getParents);
                $parent = reset($parent);
                $parentInfo = $menu_link_manager->getDefinition($parent);
            }
            if (isset($parentInfo['title'])) {
                return $parentInfo['title'];
            }
            elseif (count($parentInfo['route_parameters']) <= 0) {
                if ($parentInfo['route_name'] == "<front>") {
                    return "/";
                }
            }

            $path = '/node/' . (int) $parentInfo['route_parameters']['node'];
            $langcode = \Drupal::languageManager()
                ->getCurrentLanguage()
                ->getId();
            return \Drupal::service('path.alias_manager')
                ->getAliasByPath($path, $langcode);
        }
    }
}
