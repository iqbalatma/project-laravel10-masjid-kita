<?php

namespace App\Repositories;

use App\Models\District;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class DistrictRepository extends BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = new District();
    }
}
