<?php

namespace App\Contracts\Abstracts\Mosques;

use App\Models\Mosque;
use App\Repositories\MosqueRepository;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

abstract class BaseMosqueTransactionService extends BaseService
{
    protected Mosque $mosque;
    protected MosqueRepository $mosqueRepo;

    public function __construct()
    {
        $this->mosqueRepo = new MosqueRepository();
    }


    /**
     * Use to setter
     *
     * @param Mosque $mosque
     * @return void
     */
    protected function setMosque(Mosque $mosque): void
    {
        $this->mosque = $mosque;
    }

    /**
     * Use as getter
     *
     * @return Mosque
     */
    protected function getMosque(): Mosque
    {
        return $this->mosque;
    }

}
