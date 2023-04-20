<?php

namespace App\Services\Masters;

use App\Contracts\Interfaces\Masters\MosqueServiceInterface;
use App\Repositories\MosqueRepository;
use App\Services\BaseService;

class MosqueService extends BaseService implements MosqueServiceInterface
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new MosqueRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "masters" => "#",
            "masjid" => route("masters.districts.index")
        ];
    }


    /**
     * Use to get data for index
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Masjid",
            "cardTitle" => "Data Msjid",
            "description" => "Data masjid",
            "breadcumbs" => $this->getBreadcumbs(),
            "mosques" => $this->repository->getAllDataPaginated()
        ];
    }
}
