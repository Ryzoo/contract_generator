<?php

namespace App\Core\Helpers;

use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\ContractSettings;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Collection;

class PdfRenderer {
  private Collection $blocks;
  private Collection $formElements;
  private PDF $pdfInstance;
  private string $fullHtmlText;
  private ContractSettings $contractSettings;

  public static function blockHtmlTemplate(string $blockHtml): string {
    return $blockHtml . '';
  }

  public function __construct() {
    $this->fullHtmlText = '';
  }

  public function setParameters(Contract $contract, Collection $blocks, Collection $formElements): void {
    $this->contractSettings = $contract->settings;
    $this->blocks = $blocks;
    $this->formElements = $formElements;
  }

  public function preparePdf(): PDF {
    $this->addTag('html');
    $this->addTag('head');
    $this->configurePdf();
    $this->renderAdditionalCss();
    $this->addTag('/head');
    $this->addTag('body');
    $this->renderBlocks();
    $this->renderAdditionalScript();
    $this->addTag('/body');
    $this->addTag('/html');

    $this->pdfInstance->loadHTML($this->fullHtmlText);
    return $this->pdfInstance;
  }

  private function configurePdf(): void {
    $this->pdfInstance = \PDF::setPaper('a4', 'portrait')
      ->setWarnings(TRUE)
      ->setOptions([
        'defaultFont' => $this->contractSettings->font,
        'isPhpEnabled' => true
      ]);

    $this->fullHtmlText .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
  }

  public function renderAdditionalCss(): void {
    $this->fullHtmlText .= '<style>';
    $this->fullHtmlText .= "body { font-family: {$this->contractSettings->font}, serif ; text-align: justify; font-size: {$this->contractSettings->fontSize} }";
    $this->fullHtmlText .= 'table, table th, table td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd;} table {font-size: 15px; margin-top: 20px; margin-bottom: 40px; border-collapse: collapse; width: 100%; }';
    $this->fullHtmlText .= '.paragraph-list{display:block;text-align:center}.paragraph-list:before{content:"§"}';
    $this->fullHtmlText .= '.page-break {page-break-after: always;} .element-in-list > p {margin: 0; padding: 0; display:block;}';
    $this->fullHtmlText .= '</style>';
  }

  public function renderAdditionalScript(): void {
    $this->fullHtmlText .= '<script type="text/php">';
    $this->fullHtmlText .= 'if ( isset($pdf) ) {';
    $this->fullHtmlText .= '$text = "Strona {PAGE_NUM} z {PAGE_COUNT}";';
    $this->fullHtmlText .= '$font = $fontMetrics->get_font("Times New Roman", "normal");';
    $this->fullHtmlText .= '$size = 8;';
    $this->fullHtmlText .= '$width = $fontMetrics->get_text_width($text, $font, $size) / 2;';
    $this->fullHtmlText .= '$x = ($pdf->get_width() - $width) / 2;';
    $this->fullHtmlText .= '$y = $pdf->get_height() - 35;';
    $this->fullHtmlText .= '$color = array(0,0,0);';
    $this->fullHtmlText .= '$word_space = 0.0;';
    $this->fullHtmlText .= '$char_space = 0.0;';
    $this->fullHtmlText .= '$angle = 0.0;';
    $this->fullHtmlText .= '$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);';
    $this->fullHtmlText .= '}';
    $this->fullHtmlText .= '</script>';
  }

  private function renderBlocks(): void {
    /** @var \App\Core\Models\Domain\Blocks\Block $block */
    foreach ($this->blocks as $block) {
      $this->fullHtmlText .= self::blockHtmlTemplate($block->renderToHtml($this->formElements));
    }
  }

  private function addTag(string $tag): void {
    $this->fullHtmlText .= "<{$tag}>";
  }
}
