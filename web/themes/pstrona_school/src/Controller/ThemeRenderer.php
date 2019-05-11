<?php

namespace Drupal\pstrona_school\Controller;

use Leafo\ScssPhp\Compiler;

require __DIR__ . "/scssphp/scss.inc.php";

class ThemeRenderer {

    private $cssArray;

    /**
     * @var \Leafo\ScssPhp\Compiler
     */
    private $scssCompiler;

    private $baseFileDir;

    private $scssFileDir;

    private $baseFileName;

    private $defaultFileName;

    public function __construct(&$css) {
        $this->scssCompiler = new Compiler();
        $this->scssCompiler->setImportPaths(__DIR__ . "/../scss/");
        $this->scssCompiler->setFormatter("Leafo\ScssPhp\Formatter\Crunched");
        $this->cssArray = &$css;
        $this->baseFileDir = drupal_get_path('theme', "pstrona_school") . "/css/";
        $this->scssFileDir = drupal_get_path('theme', "pstrona_school") . "/src/scss/";
        $this->baseFileName = "_renderedStyle.css";
        $this->defaultFileName = "main.scss";
    }

    public function render() {
        if (!file_exists($this->baseFileDir . $this->baseFileName)
            || !file_exists($this->scssFileDir . "_pageColorsTMP.scss")
            || $this->fileIsOutdated()
            || $this->checkDirIsModified($this->scssFileDir)) {
            $this->parseDefaultCss();
        }
    }

    private function fileIsOutdated(): bool {
        $line = fgets(fopen($this->scssFileDir . "_pageColorsTMP.scss", 'r'));
        return !(strpos($line, $this->getNewColorString()) !== FALSE);
    }

    private function parseDefaultCss() {
        $this->changeColor();
        $content = $this->compileScss();
        $this->save($content);
    }

    private function getDefaultContent() {
        return file_get_contents($this->scssFileDir . $this->defaultFileName);
    }

    private function compileScss(): string {
        try {
            return $this->scssCompiler->compile($this->getDefaultContent());
        } catch (\Exception $e) {
            echo 'scssphp: Unable to compile content';
            syslog(LOG_ERR, 'scssphp: Unable to compile content');
        }
    }

    private function save(&$content) {
        file_put_contents($this->baseFileDir . $this->baseFileName, $content);
    }

    private function getNewColorString(): string {
        $colors = $this->getColorList();

        $dynamicColorString = '$colorsDefaults: (';

        foreach ($colors as $key => $colorItem) {
            $index = $colorItem[0];
            $settingsColor = theme_get_setting("color_{$index}");

            $startColon = $key === 0 ? '' : ',';
            $dynamicColorString .= $startColon . $index . ": " . $settingsColor;
        }

        $dynamicColorString .= ');';

        return $dynamicColorString;
    }

    private function changeColor() {
        $defaultPageColors = file_get_contents($this->scssFileDir . "_pageColors.scss");
        file_put_contents($this->scssFileDir . "_pageColorsTMP.scss", $this->getNewColorString() . " " . $defaultPageColors);
    }

    public static function configureSettingsForm(&$form) {
        $colors = ThemeRenderer::getColorList();

        if (count($colors) > 0) // ustawienia koloru
        {
            $form['pstrona_school_color_settings'] = [
                '#type' => 'details',
                '#title' => t('Ustawienia koloru'),
                '#description' => t('Ustaw kolory uzywane na stronie.'),
                '#weight' => -1000,
                '#open' => TRUE,
            ];
        }

        foreach ($colors as $colorItem) {
            $index = $colorItem[0];
            $color = $colorItem[1];
            $name = $colorItem[2];
            $description = $colorItem[3];
            $default = theme_get_setting("color_{$index}");

            $form['pstrona_school_color_settings']["color_{$index}"] = [
                '#type' => 'color',
                '#title' => t($name),
                '#default_value' => isset($default) ? $default : $color,
                '#description' => t($description),
            ];
        }
    }

    public static function getColorList() {
        $path = drupal_get_path('theme', "pstrona_school") . "/src/scss/colorConfig.json";

        if (file_exists($path)) {
            return json_decode(file_get_contents($path))->colorsDefaults;
        }

        return [];
    }

    public static function addCss(&$css, $content, $isExternal = TRUE) {
        $css[$content] = [
            'weight' => 0.043,
            'group' => 0,
            'type' => $isExternal ? "external" : "file",
            'data' => $content,
            'version' => "5.2.0",
            'media' => "all",
            'preprocess' => TRUE,
            'browsers' => [
                'IE' => TRUE,
                '!IE' => TRUE,
            ],
        ];

    }

    private function checkDirIsModified($dir):bool {
        $lastHash =  file_exists($this->baseFileDir . "renderHash.txt") ? file_get_contents($this->baseFileDir . "renderHash.txt") : '';

        $files = $this->getDirFilesArray($dir);
        $lastRenderString = '';

        foreach ($files as $file){
            $lastRenderString .= filemtime($file);
        }

        $lastRenderString = md5($lastRenderString);
        file_put_contents($this->baseFileDir . "renderHash.txt",$lastRenderString);

        return $lastHash !== $lastRenderString;
    }

    private function getDirFilesArray($dir, &$results = array()){
        $files = scandir($dir);

        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                if (!(strpos($path, '_pageColorsTMP.scss') !== false)) {
                    $results[] = $path;
                }
            } else if($value != "." && $value != "..") {
                $this->getDirFilesArray($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }
}