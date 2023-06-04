<?php

namespace App\Repositories;

use App\Models\Mosque;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class MosqueRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Mosque();
    }
}
