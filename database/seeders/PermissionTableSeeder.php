<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboards',
            'users',
            'roles',
            'categories',
            'sub_categories',
            'products',
            'faqs',
            'cities',
            'countries'
        ];

        foreach ($permissions as $key => $permission) {
            Artisan::call('crescent:auth:permission', ['name' => $permission]);
        }
    }
}
