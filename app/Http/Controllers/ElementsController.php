<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Repository\AttributeRepository;
use App\Core\Repository\BlockRepository;
use App\Core\Repository\ConditionalRepository;
use App\Core\Services\Contract\ConditionalService;

class ElementsController extends Controller
{
    private BlockRepository $blockRepository;
    private ConditionalRepository $conditionalRepository;
    private AttributeRepository $attributeRepository;

    public function __construct(BlockRepository $blockRepository, ConditionalRepository $conditionalRepository, AttributeRepository $attributeRepository) {
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
