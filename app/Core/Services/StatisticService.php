<?php


namespace App\Core\Services;


use App\Core\Enums\StatisticType;
use App\Core\Helpers\Response;
use App\Core\Models\Database\Contract;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Models\Database\User;
use App\Core\Models\Domain\Statistic;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticService {

  public function getStatistic(int $statisticType) {
    switch ($statisticType){
      case StatisticType::REGISTRATIONS:
        return $this->getRegistrationStatistic();
      case StatisticType::NEW_CONTRACTS:
        return $this->getContractStatistic();
      case StatisticType::SUBMISSIONS:
        return $this->getSubmissionStatistic();
    }

    Response::error(__('response.notFoundStatistic'));
  }

  private function getRegistrationStatistic(){
    $newUsers = User::select(DB::raw('count(*) as count, DATE_FORMAT(created_at, \'%d-%m-%Y\') as date'))
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->groupBy('date')
      ->get();

    $last = User::select('created_at')
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->latest()
      ->first();

    return new Statistic($newUsers, $last ? (new Carbon($last->created_at))->diffForHumans() : null);
  }

  private function getContractStatistic(){
    $newUsers = Contract::select(DB::raw('count(*) as count, DATE_FORMAT(created_at, \'%d-%m-%Y\') as date'))
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->groupBy('date')
      ->get();

    $last = Contract::select('created_at')
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->latest()
      ->first();

    return new Statistic($newUsers, $last ? (new Carbon($last->created_at))->diffForHumans() : null);
  }

  private function getSubmissionStatistic(){
    $newUsers = ContractFormComplete::select(DB::raw('count(*) as count, DATE_FORMAT(created_at, \'%d-%m-%Y\') as date'))
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->groupBy('date')
      ->get();

    $last = ContractFormComplete::select('created_at')
      ->where('created_at', '>', Carbon::now()->subDays(7))
      ->latest()
      ->first();

    return new Statistic($newUsers, $last ? (new Carbon($last->created_at))->diffForHumans() : null);
  }
}
