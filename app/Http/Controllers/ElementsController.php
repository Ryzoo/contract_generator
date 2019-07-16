<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Services\AuthService;
use App\Services\Domain\BlockService;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    /**
     * @var BlockService
     */
    private $blockService;

    public function __construct(BlockService $blockService) {
        $this->blockService = $blockService;
    }

    public function getAllBlockList(Request $request) {
        $blockList = $this->blockService->getListOfBlocks();
        Response::success($blockList);
    }
}
