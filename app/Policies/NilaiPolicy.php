<?php

// app/Policies/NilaiPolicy.php
namespace App\Policies;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NilaiPolicy
{
    use HandlesAuthorization;

    public function guruOnly(User $user)
    {
        return $user->role === 'guru';
    }

    public function update(User $user, Nilai $nilai)
    {
        return $user->role === 'guru' && $nilai->guru_id === $user->id;
    }

    public function delete(User $user, Nilai $nilai)
    {
        return $user->role === 'guru' && $nilai->guru_id === $user->id;
    }
}

