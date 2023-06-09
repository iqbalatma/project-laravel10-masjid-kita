<?php

namespace App\Repositories;

use App\Models\Village;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class VillageRepository extends BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = new Village();
    }
}
