<?php

namespace App\Repositories;

use App\Models\TransactionImage;

class TransactionImageRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new TransactionImage();
    }
}
