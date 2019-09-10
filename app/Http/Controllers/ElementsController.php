<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Repository\Domain\AttributeRepository;
use App\Repository\Domain\BlockRepository;
use App\Repository\Domain\ConditionalRepository;
use App\Services\Domain\AttributeService;
use App\Services\Domain\BlockService;
use App\Services\Domain\ConditionalService;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    /**
     * @var BlockService
     */
    private $blockService;

    /**
     * @var AttributeService
     */
    private $attributeService;

    /**
     * @var ConditionalService
     */
    private $conditionalService;

    /**
     * @var \App\Repository\Domain\BlockRepository
     */
    private $blockRepository;

    /**
     * @var \App\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    /**
     * @var \App\Repository\Domain\AttributeRepository
     */
    private $attributeRepository;

    public function __construct(BlockService $blockService, AttributeService $attributeService, ConditionalService $conditionalService,
                                BlockRepository $blockRepository, ConditionalRepository $conditionalRepository, AttributeRepository $attributeRepository) {
        $this->blockService = $blockService;
        $this->attributeService = $attributeService;
        $this->conditionalService = $conditionalService;
        $this->blockRepository = $blockRepository;
        $this->conditionalRepository = $conditionalRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function getAllBlockList(Request $request) {
        $blockList = $this->blockRepository->getListOfBlocks();
        Response::success($blockList);
    }

    public function getAllAttributesList(Request $request) {
        $attributeList = $this->attributeRepository->getListOfAttributes();
        Response::success($attributeList);
    }

    public function getAllConditionalList(Request $request) {
        $conditionalList = $this->conditionalRepository->getListOfConditional();
        Response::success($conditionalList);
    }
}
