<?php

namespace App\Repositories;

use App\Models\Subdistrict;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class SubdistrictRepository extends BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = new Subdistrict();
    }
}
