<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Core\Repository\Domain\AttributeRepository;
use App\Core\Repository\Domain\BlockRepository;
use App\Core\Repository\Domain\ConditionalRepository;
use App\Core\Services\Domain\ConditionalService;

class ElementsController extends Controller
{
    /**
     * @var ConditionalService
     */
    private $conditionalService;

    /**
     * @var \App\Core\Repository\Domain\BlockRepository
     */
    private $blockRepository;

    /**
     * @var \App\Core\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    /**
     * @var \App\Core\Repository\Domain\AttributeRepository
     */
    private $attributeRepository;

    public function __construct(ConditionalService $conditionalService,
                                BlockRepository $blockRepository, ConditionalRepository $conditionalRepository, AttributeRepository $attributeRepository) {
        $this->conditionalService = $conditionalService;
        $this->blockRepository = $blockRepository;
        $this->conditionalRepository = $conditionalRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function getAllBlockList() {
        $blockList = $this->blockRepository->getListOfBlocks();
        Response::success($blockList);
    }

    public function getAllAttributesList() {
        $attributeList = $this->attributeRepository->getListOfAttributes();
        Response::success($attributeList);
    }

    public function getAllConditionalList() {
        $conditionalList = $this->conditionalRepository->getListOfConditional();
        Response::success($conditionalList);
    }
}
