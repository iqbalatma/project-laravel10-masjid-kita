<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\SubdistrictServiceInterface;
use App\Repositories\Masters\SubdistrictRepository;
use App\Services\BaseService;

class SubdistrictService extends BaseService implements SubdistrictServiceInterface
{
    protected $repository;
    protected array $breadcumbs;
    public function __construct()
    {
        $this->repository = new SubdistrictRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "Master",
            "subdistricts" => route("masters.subdistricts.index")
        ];
    }


    /**
     * use to get all data subdsitrict
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Subdstricts",
            "description" => "Data of subdistrict",
            "breadcumbs" => $this->getBreadcumbs(),
            "subdistricts" => $this->repository->getAllDataPaginated()
        ];
    }
}
