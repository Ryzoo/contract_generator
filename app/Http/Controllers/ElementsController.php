<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Services\AuthService;
use App\Services\Domain\AttributeService;
use App\Services\Domain\BlockService;
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

    public function __construct(BlockService $blockService,AttributeService $attributeService) {
        $this->blockService = $blockService;
        $this->attributeService = $attributeService;
    }

    public function getAllBlockList(Request $request) {
        $blockList = $this->blockService->getListOfBlocks();
        Response::success($blockList);
    }

    public function getAllAttributesList(Request $request) {
        $atributeList = $this->attributeService->getListOfAttributes();
        Response::success($atributeList);
    }
}
