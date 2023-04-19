<?php

namespace App\Repositories\Masters;

use App\Models\Role;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class RoleRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Role();
    }
}
