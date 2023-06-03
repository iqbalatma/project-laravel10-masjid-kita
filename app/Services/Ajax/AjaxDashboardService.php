<?php

namespace App\Services\Ajax;

use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AjaxDashboardService extends \App\Services\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
    }


    /**
     * @return array
     */
    public function getAllData():array
    {
        $transactions = collect($this->repository->getDataTransactionDailyInAMonth());
        $startDate = Carbon::createFromFormat('Y-m-d', $transactions->first()->date);
        $endDate = Carbon::createFromFormat('Y-m-d', $transactions->last()->date);
        $categories =  CarbonPeriod::create($startDate, $endDate);
        return [
            "transactions" => $transactions,
            "categories" => $categories,
        ];
    }
}
