<?php

namespace App\Services;

use Iqbalatma\LaravelServiceRepo\BaseService as LaravelServiceRepoBaseService;

abstract class BaseService extends LaravelServiceRepoBaseService
{
    protected $repository;
    protected array $breadcumbs;

    /**
     * Use to get all data breadcumbs
     *
     * @return array
     */
    public function getBreadcumbs(): array
    {
        return $this->breadcumbs;
    }

    /**
     * Use to add new breadcumb
     *
     * @param array $newBreadcumbs
     * @return void
     */
    public function addBreadCumbs(array $newBreadcumbs): void
    {
        foreach ($newBreadcumbs as $key => $breadcumb) {
            $this->breadcumbs[$key] = $breadcumb;
        }
    }
}
