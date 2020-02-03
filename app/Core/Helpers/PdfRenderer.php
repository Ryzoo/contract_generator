<?php


namespace App\Core\Helpers;


use App\Core\Enums\ConditionalType;
use App\Core\Models\Database\Contract;
use Illuminate\Support\Collection;
use PDF;

class PdfRenderer{
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

    public static function blockHtmlTemplate(string $blockHtml) : string{
      return $blockHtml . '<br/>';
    }

    public function __construct() {
        $this->fullHtmlText = '';
    }

    public function setParameters(Contract $contract, Collection $blocks, Collection $formElements) {
        $this->contract = $contract;
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

        $this->pdfInstance->loadHTML($this->fullHtmlText);
        return $this->pdfInstance;
    }

    private function configurePdf() {
        $this->pdfInstance = PDF::setPaper('a4', 'portrait')
            ->setWarnings(true);

        $this->fullHtmlText .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    }

    public function renderAdditionalCss() {
        $this->fullHtmlText .= '<style>';

        foreach ($this->blocks as $block)
            $this->fullHtmlText .= $block->renderAdditionalCss();

        $this->fullHtmlText .= 'body { font-family: DejaVu Sans; }';

        $this->fullHtmlText .= '</style>';

    }

    private function renderBlocks() {
        /** @var \App\Core\Models\Domain\Blocks\Block $block */
        foreach ($this->blocks as $block){
            $this->fullHtmlText .= self::blockHtmlTemplate($block->renderToHtml($this->formElements));
        }
    }

    private function addTag(string $tag){
        $this->fullHtmlText .= "<{$tag}>";
    }
}
