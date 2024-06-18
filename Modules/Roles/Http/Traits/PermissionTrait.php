<?php

namespace Modules\Roles\Http\Traits;

trait PermissionTrait
{
    public static function getData()
    {
        return collect([
            [
                'type' => 'manage-user',
                'title' => 'view-users'
            ],
            [
                'type' => 'manage-user',
                'title' => 'change-status-user'
            ],
            [
                'type' => 'manage-user',
                'title' => 'create-user'
            ],
            [
                'type' => 'manage-user',
                'title' => 'edit-user'
            ],
            [
                'type' => 'manage-user',
                'title' => 'delete-user'
            ],







            [
                'type' => 'manage-role',
                'title' => 'view-roles'
            ],
            [
                'type' => 'manage-role',
                'title' => 'change-status-role'
            ],
            [
                'type' => 'manage-role',
                'title' => 'manage-permissions'
            ],
            [
                'type' => 'manage-role',
                'title' => 'create-role'
            ],
            [
                'type' => 'manage-role',
                'title' => 'edit-role'
            ],
            [
                'type' => 'manage-role',
                'title' => 'delete-role'
            ],







            [
                'type' => 'category',
                'title' => 'view-category'
            ],
            [
                'type' => 'category',
                'title' => 'create-category'
            ],
            [
                'type' => 'category',
                'title' => 'edit-category'
            ],
            [
                'type' => 'category',
                'title' => 'delete-category'
            ],







            [
                'type' => 'data-product',
                'title' => 'view-data-product'
            ],
            [
                'type' => 'data-product',
                'title' => 'create-data-product'
            ],
            [
                'type' => 'data-product',
                'title' => 'edit-data-product'
            ],
            [
                'type' => 'data-product',
                'title' => 'delete-data-product'
            ],







            [
                'type' => 'penghuni',
                'title' => 'view-penghuni'
            ],
            [
                'type' => 'penghuni',
                'title' => 'create-penghuni'
            ],
            [
                'type' => 'penghuni',
                'title' => 'edit-penghuni'
            ],
            [
                'type' => 'penghuni',
                'title' => 'cek-riwayat-tagihan'
            ],
            [
                'type' => 'penghuni',
                'title' => 'atur-pindah-kamar'
            ],
            [
                'type' => 'penghuni',
                'title' => 'atur-berhenti-menghuni'
            ],
            [
                'type' => 'penghuni',
                'title' => 'delete-penghuni'
            ],







            [
                'type' => 'tagihan',
                'title' => 'view-tagihan'
            ],
            [
                'type' => 'tagihan',
                'title' => 'create-tagihan'
            ],
            [
                'type' => 'tagihan',
                'title' => 'edit-tagihan'
            ],
            [
                'type' => 'tagihan',
                'title' => 'delete-tagihan'
            ],







            [
                'type' => 'general-settings',
                'title' => 'set-fee-admin'
            ],
            [
                'type' => 'general-settings',
                'title' => 'change-password'
            ],







            [
                'type' => 'kas',
                'title' => 'view-kas'
            ],
            [
                'type' => 'kas',
                'title' => 'create-kas'
            ],
            [
                'type' => 'kas',
                'title' => 'edit-kas'
            ],
            [
                'type' => 'kas',
                'title' => 'delete-kas'
            ],







            [
                'type' => 'laba-rugi',
                'title' => 'view-laba-rugi'
            ],
        ]);
    }
}
