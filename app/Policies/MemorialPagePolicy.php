<?php

namespace App\Policies;

use App\Models\MemorialPage;
use App\Models\User;

class MemorialPagePolicy
{
    public function update(User $user, MemorialPage $memorialPage): bool
    {
        return $memorialPage->isAdministeredBy($user);
    }

    public function delete(User $user, MemorialPage $memorialPage): bool
    {
        return $user->id === $memorialPage->user_id;
    }

    public function manageAdmins(User $user, MemorialPage $memorialPage): bool
    {
        return $user->id === $memorialPage->user_id;
    }
}
