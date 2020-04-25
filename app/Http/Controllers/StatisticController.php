<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Services\StatisticService;
use Illuminate\Http\Request;

class StatisticController extends Controller {
  protected StatisticService $statisticService;

  public function __construct(StatisticService $statisticService) {
    $this->statisticService = $statisticService;
  }

  public function getStatistic(Request $request, int $type) {
    Response::success($this->statisticService->getStatistic($type));
  }
}
