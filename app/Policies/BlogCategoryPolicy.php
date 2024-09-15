<?php

namespace App\Policies;

use App\Models\BlogCategory;
use App\Models\User;

class BlogCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any-blog-category');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogCategory $blogcategory): bool
    {
        return $user->checkPermissionTo('view-blog-category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create-blog-category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogCategory $blogcategory): bool
    {
        return $user->checkPermissionTo('update-blog-category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogCategory $blogcategory): bool
    {
        return $user->checkPermissionTo('delete-blog-category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogCategory $blogcategory): bool
    {
        return $user->checkPermissionTo('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogCategory $blogcategory): bool
    {
        return $user->checkPermissionTo('{{ forceDeletePermission }}');
    }
}
