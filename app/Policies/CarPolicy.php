<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cars.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view a specific car.
     */
    public function view(User $user, Car $car)
    {
        return true;
    }

    /**
     * Determine whether the user can create a car.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update a car.
     */
    public function update(User $user, Car $car)
    {
        return true;
    }

    /**
     * Determine whether the user can delete a car.
     */
    public function delete(User $user, Car $car)
    {
        return true;
    }

    /**
     * Determine whether the user can restore a car.
     */
    public function restore(User $user, Car $car)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete a car.
     */
    public function forceDelete(User $user, Car $car)
    {
        return true;
    }
}
