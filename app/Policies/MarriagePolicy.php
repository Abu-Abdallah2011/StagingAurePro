<?php

namespace App\Policies;

use App\Models\User;
use App\Models\marriagesModel;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class MarriagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function activate(User $user, marriagesModel $marriage): bool
    {
        // Check if the user is Admin or part of the Masjid leadership (Chairman, Imam, Muazzin)
        return Gate::allows('isAdmin', $user) || 
       ($marriage->masjid && $user->profile->id == $marriage->masjid->chairman_id) || 
       ($marriage->masjid && $user->profile->id == $marriage->masjid->imam_id) || 
       ($marriage->masjid && $user->profile->id == $marriage->masjid->muazzin_id);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, marriagesModel $marriagesModel): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, marriagesModel $marriagesModel): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, marriagesModel $marriagesModel): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, marriagesModel $marriagesModel): bool
    {
        //
    }
}
