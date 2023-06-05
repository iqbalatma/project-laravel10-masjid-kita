<?php

namespace App\Policies;

use App\Models\Mosque;
use App\Models\User;

class MosquePolicy
{
    public function index(User $user, Mosque $mosque):bool
    {
        return $mosque->users->contains($user);
    }

    public function store(User $user, Mosque $mosque):bool
    {
        return $mosque->users->contains($user);
    }

    public function update(User $user, Mosque $mosque):bool
    {
        return $mosque->users->contains($user);
    }
}
