<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Tour;
use App\Models\User;

class TourPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tour $tour): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return $user->role === 'admin';
        return $user->hasRole('admin'); 
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tour $tour): bool
    {
        // return $user->id === $tour->user_id || $user->role === 'admin';
        return $user->id === $tour->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tour $tour): bool
    {
        // return $user->id === $tour->user_id || $user->role === 'admin';
        return $user->id === $tour->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tour $tour): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tour $tour): bool
    {
        return $user->hasRole('admin');
    }
}
