<?php


namespace App\Helpers;


use App\Models\Domain\Contract;
use Barryvdh\DomPDF\PDF;

class PdfRenderer{
    /**
     * @var \App\Models\Domain\Contract
     */
    private $contract;

    /**
     * @var array
     */
    private $blocks;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var PDF
     */
    private $pdfInstance;

    /**
     * @var string
     */
    private $fullHtmlText;


    public function __construct() {
        $this->fullHtmlText = "";
    }

    public function setParameters(Contract $contract, array $blocks, array $attributes) {
        $this->contract = $contract;
        $this->blocks = $blocks;
        $this->attributes = $attributes;
    }

    public function preparePdf():PDF {
        $this->configurePdf();
        $this->renderBlocks();

        $this->pdfInstance->loadHTML($this->fullHtmlText);
        return $this->pdfInstance;
    }

    private function configurePdf() {
        $this->pdfInstance = \PDF::setPaper('a4', 'landscape')
            ->setWarnings(true);
    }

    private function renderBlocks() {
        foreach ($this->blocks as $block){
            $this->fullHtmlText .= $block->renderToHtml($this->attributes);
            $this->fullHtmlText .= "<br/>";
        }
    }
}
