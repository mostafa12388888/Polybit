<?php

namespace App\Policies;

use App\Models\StoreCategory;
use App\Models\User;

class StoreCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any-store-category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StoreCategory $storecategory): bool
    {
        return $user->checkPermissionTo('view-store-category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create-store-category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StoreCategory $storecategory): bool
    {
        return $user->checkPermissionTo('update-store-category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StoreCategory $storecategory): bool
    {
        return $user->checkPermissionTo('delete-store-category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StoreCategory $storecategory): bool
    {
        return $user->checkPermissionTo('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StoreCategory $storecategory): bool
    {
        return $user->checkPermissionTo('{{ forceDeletePermission }}');
    }
}
