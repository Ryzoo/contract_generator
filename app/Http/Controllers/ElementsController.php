<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
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

    public function __construct(BlockService $blockService, AttributeService $attributeService, ConditionalService $conditionalService) {
        $this->blockService = $blockService;
        $this->attributeService = $attributeService;
        $this->conditionalService = $conditionalService;
    }

    public function getAllBlockList(Request $request) {
        $blockList = $this->blockService->getListOfBlocks();
        Response::success($blockList);
    }

    public function getAllAttributesList(Request $request) {
        $atributeList = $this->attributeService->getListOfAttributes();
        Response::success($atributeList);
    }

    public function getAllConditionalList(Request $request) {
        $conditionalList = $this->conditionalService->getListOfConditional();
        Response::success($conditionalList);
    }
}
