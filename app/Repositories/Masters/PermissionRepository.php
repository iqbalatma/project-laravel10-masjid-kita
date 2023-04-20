<?php

namespace App\Repositories\Masters;

use App\Models\Permission;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class PermissionRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Permission();
    }
}
