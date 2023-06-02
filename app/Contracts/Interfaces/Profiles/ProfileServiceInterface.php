<?php

namespace App\Contracts\Interfaces\Profiles;

interface ProfileServiceInterface
{
    public function getEditData():array;
    public function updateDataById(array $requestedData):array;
}
