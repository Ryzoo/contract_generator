<?php


namespace App\Core\Helpers;


use App\Core\Enums\ConditionalType;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\ContractSettings;
use Illuminate\Support\Collection;
use PDF;

class PdfRenderer {

  /**
   * @var Contract
   */
  private $contract;

  /**
   * @var Collection
   */
  private $blocks;

  /**
   * @var Collection
   */
  private $formElements;

  /**
   * @var \PDF
   */
  private $pdfInstance;

  /**
   * @var string
   */
  private $fullHtmlText;

  /**
   * @var ContractSettings $contractSettings
   */
  private $contractSettings;

  public static function blockHtmlTemplate(string $blockHtml): string {
    return $blockHtml . '';
  }

  public function __construct() {
    $this->fullHtmlText = '';
  }

  public function setParameters(Contract $contract, Collection $blocks, Collection $formElements): void {
    $this->contract = $contract;
    $this->contractSettings = $contract->settings;
    $this->blocks = $blocks;
    $this->formElements = $formElements;
  }

  public function preparePdf() {
    $this->addTag('html');
    $this->addTag('head');
    $this->configurePdf();
    $this->renderAdditionalCss();
    $this->addTag('/head');
    $this->addTag('body');
    $this->renderBlocks();
    $this->addTag('/body');
    $this->addTag('/html');

    $html = str_replace(['<p>', '</p>'], [
      '<div>',
      '</div>'
    ], $this->fullHtmlText);

    $this->pdfInstance->loadHTML($html);
    return $this->pdfInstance;
  }

  private function configurePdf(): void {
    $this->pdfInstance = PDF::setPaper('a4', 'portrait')
      ->setWarnings(TRUE)
      ->setOptions([
        'defaultFont' => $this->contractSettings->font
      ]);

    $this->fullHtmlText .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
  }

  public function renderAdditionalCss(): void {
    $this->fullHtmlText .= '<style>';

    foreach ($this->blocks as $block) {
      $this->fullHtmlText .= $block->renderAdditionalCss();
    }
    $this->fullHtmlText .= "body { font-family: {$this->contractSettings->font}, serif ; text-align: justify; font-size: {$this->contractSettings->fontSize} }";
    $this->fullHtmlText .= 'table, table th, table td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd;} table {font-size: 15px; margin-top: 20px; margin-bottom: 40px; border-collapse: collapse; width: 100%; }';
    $this->fullHtmlText .= '</style>';
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
