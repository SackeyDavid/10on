<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create($admin, Model $model)
    {
        if ($admin instanceof Admin) {
            return $admin->id == $userId;
        }

        // Is an Admin
        return true;
    }
}
