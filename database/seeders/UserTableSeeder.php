<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name'              => 'Admin',
                'slug'              => Str::slug('Admin'),
                'email'             => 'admin@admin.com',
                'email_verified_at' => '2025-09-14 14:33:40',                
                'password'          => bcrypt('secret'),
                'remember_token'    => Str::random(10),
                'role_id'           => 1, 
                'active'            => true,
            ]
        );
    }
}
