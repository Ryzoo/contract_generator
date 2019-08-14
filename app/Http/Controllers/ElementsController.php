<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Services\Domain\AttributeService;
use App\Services\Domain\BlockService;
use App\Services\Domain\ConditionalService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *   title="My first API",
 *   version="1.0.0",
 *   @OA\Contact(
 *     email="support@example.com"
 *   )
 * )
 */

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

    /**
     * @OA\Get(
     *   path="/api/elements/blocks",
     *   summary="list blocks",
     *   @OA\Response(
     *     response=200,
     *     description="A list with blocks"
     *   )
     * )
     */
    public function getAllBlockList(Request $request) {
        $blockList = $this->blockService->getListOfBlocks();
        Response::success($blockList);
    }

    /**
     * @OA\Get(
     *   path="/api/elements/attributes",
     *   summary="list attributes",
     *   @OA\Response(
     *     response=200,
     *     description="A list with attributes"
     *   )
     * )
     */
    public function getAllAttributesList(Request $request) {
        $atributeList = $this->attributeService->getListOfAttributes();
        Response::success($atributeList);
    }

    /**
     * @OA\Get(
     *   path="/api/elements/conditional",
     *   summary="list conditional",
     *   @OA\Response(
     *     response=200,
     *     description="A list with conditional"
     *   )
     * )
     */
    public function getAllConditionalList(Request $request) {
        $conditionalList = $this->conditionalService->getListOfConditional();
        Response::success($conditionalList);
    }
}
