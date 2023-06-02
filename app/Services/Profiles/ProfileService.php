<?php

namespace App\Services\Profiles;

use App\Contracts\Interfaces\Profiles\ProfileServiceInterface;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class ProfileService extends BaseService implements ProfileServiceInterface
{

    protected $repository;
    protected array $breadcumbs;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->breadcumbs = [
            "dashboard" => "Dashboard",
            "profile" => "#",
        ];
    }

    /**
     * @return array
     */
    public function getEditData(): array
    {
        try {
            $response = [
                "title" => "Profile",
                "cardTitle" => "Profile",
                "description" => "Manajemen Profile",
                "breadcumbs" => $this->getBreadcumbs(),
                "user" => $this->repository->getDataById(Auth::id()),
                "success" => true
            ];
        } catch (\Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(array $requestedData):array
    {
        try {
            $this->checkData(Auth::id());
            $user = $this->getServiceEntity();

            $user->fill($requestedData);
            $user->save();

            $response = [
                "success" => true
            ];
        }catch (\Exception $e){
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


}
