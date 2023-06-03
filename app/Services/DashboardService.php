<?php

namespace App\Services;

use App\Contracts\Interfaces\DashboardServiceInterface;
use App\Repositories\TransactionRepository;

class DashboardService extends BaseService implements  DashboardServiceInterface
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
        try {
            $response = [
                "success" => true,
                "title" => "Dashboard",
                "cardTitle" => "Dashboard",
                "description" => "Description",
            ];
        } catch (\Exception $e){
            $response = getDefaultErrorResponse();
        }

        return $response;
    }

}
