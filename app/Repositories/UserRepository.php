<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::where('role', 'user')->paginate(10);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        return $user ? $user->restore() : false;
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);
        return $user ? $user->forceDelete() : false;
    }

    public function getAllWithTrashed()
    {
        return User::onlyTrashed()->get();
    }
}
