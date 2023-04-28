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

    public function getDataByWhereClausePaginated(array $whereClause, array $columns = ["*"])
    {
        return $this->model
            ->select($columns)
            ->where($whereClause)
            ->paginate(request()->query("perpage", config("servicerepo.perpage")));
    }
}
