<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\DistrictServiceInterface;
use App\Repositories\Masters\DistrictRepository;
use App\Services\BaseService;

class DistrictService extends BaseService implements DistrictServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new DistrictRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "kabupaten" => route("masters.districts.index")
        ];
    }
    public function getAllData(): array
    {
        return [
            "title" => "Kabupaten",
            "description" => "Data kabupaten",
            "breadcumbs" => $this->getBreadcumbs(),
            "districts" => $this->repository->getAllDataPaginated()
        ];
    }
}
