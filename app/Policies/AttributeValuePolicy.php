<?php

namespace App\Policies;

use App\Models\AttributeValue;
use App\Models\User;

class AttributeValuePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any-attribute-value');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AttributeValue $attributevalue): bool
    {
        return $user->checkPermissionTo('view-attribute-value');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create-attribute-value');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AttributeValue $attributevalue): bool
    {
        return $user->checkPermissionTo('update-attribute-value');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttributeValue $attributevalue): bool
    {
        return $user->checkPermissionTo('delete-attribute-value');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttributeValue $attributevalue): bool
    {
        return $user->checkPermissionTo('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttributeValue $attributevalue): bool
    {
        return $user->checkPermissionTo('{{ forceDeletePermission }}');
    }
}
