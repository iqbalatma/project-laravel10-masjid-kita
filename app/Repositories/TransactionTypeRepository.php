<?php

namespace App\Repositories;

use App\Models\TransactionType;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class TransactionTypeRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new TransactionType();
    }
}
