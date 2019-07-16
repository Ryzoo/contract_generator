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

    /**
     * @OA\Get(
     *      path="/api/elements/blocks",
     *      tags={"Blocks"},
     *      operationId="getAllBlockList",
     *      summary="Get list of available blocks type",
     *      description="Get list of available blocks type",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *       ),
     *     )
     */
    public function getAllBlockList(Request $request) {
        $blockList = $this->blockService->getListOfBlocks();
        Response::success($blockList);
    }

    /**
     * @OA\Get(
     *      path="/api/elements/attributes",
     *      tags={"Attributes"},
     *      operationId="getAllAttributesList",
     *      summary="Get list of available attirubtes type",
     *      description="Get list of available attirubtes type",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *       ),
     *     )
     */
    public function getAllAttributesList(Request $request) {
        $atributeList = $this->attributeService->getListOfAttributes();
        Response::success($atributeList);
    }
}
