<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    public function getAll()
    {
        return Cache::remember('users.paginated', 60, function () {
            // $users = User::all();

            // return User::where('role', 'user')->paginate(10);
            // return $roles = $users->roles()->paginate(10);

            return User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->paginate(10);
        });
    }

    public function findById($id)
    {
        return Cache::remember('user.{id}', 60, function() use($id) {
            return User::findOrFail($id);
        });
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            Cache::forget('users.paginated');
            return true;
        }
        return false;
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->forceDelete();
            Cache::forget("user.{$id}");
            Cache::forget('users.paginated');
            return true;
        }
        return $user ? $user->forceDelete() : false;
    }

    public function getAllWithTrashed()
    {
        return Cache::remember('users.trashed', 60, function () {
            return User::onlyTrashed()->get();
        });
        
    }
}
