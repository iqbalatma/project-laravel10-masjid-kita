<?php

namespace App\Repositories;

use App\Models\Transaction;
use Iqbalatma\LaravelServiceRepo\BaseRepository;


class TransactionRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }
}
