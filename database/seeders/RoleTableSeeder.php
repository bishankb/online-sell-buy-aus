<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['display_name' => 'admin', 'name' => 'admin']);
        Role::create(['display_name' => 'Developer', 'name' => 'developer']);
        Role::create(['display_name' => 'User', 'name' => 'user']);

        User::where('id', 1)->first()->assignRole('admin');
    }
}
