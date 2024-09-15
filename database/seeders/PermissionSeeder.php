<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (['user', 'project', 'blog-category', 'post', 'store-category', 'product', 'attribute', 'attribute-value', 'slide', 'faq', 'page', 'role', 'media'] as $resource) {
            foreach (['view-any', 'view', 'create', 'update', 'delete'] as $permission) {
                Permission::create(['name' => $permission.'-'.$resource]);
            }
        }

        foreach (['view-any-order', 'view-order', 'view-any-permission', 'view-permission', 'update-order', 'view-any-message', 'view-message', 'update-message', 'update-settings', 'view-any-activity', 'view-activity', 'update-translations'] as $permission) {
            Permission::create(['name' => $permission]);
        }

        $all_permissions = Permission::pluck('name')->toArray();

        $role = Role::create(['name' => 'مدير عام']);
        $role->givePermissionTo($all_permissions);

        $role = Role::create(['name' => 'مدير']);
        $role->givePermissionTo(array_diff_key($all_permissions, array_flip(['update-settings', 'view-activity-log', 'update-translations'])));

        $role = Role::create(['name' => 'محرر للمدونة']);
        $role->givePermissionTo(['view-any-blog-category', 'view-blog-category', 'create-blog-category', 'update-blog-category', 'delete-blog-category', 'view-any-post', 'view-post', 'create-post', 'update-post', 'delete-post']);

        $role = Role::create(['name' => 'مدير للمتجر']);
        $role->givePermissionTo(['view-any-store-category', 'view-store-category', 'create-store-category', 'update-store-category', 'delete-store-category', 'view-any-product', 'view-product', 'create-product', 'update-product', 'delete-product', 'view-any-attribute', 'view-attribute', 'create-attribute', 'update-attribute', 'delete-attribute', 'view-any-attribute-value', 'view-attribute-value', 'create-attribute-value', 'update-attribute-value', 'delete-attribute-value']);
    }
}
