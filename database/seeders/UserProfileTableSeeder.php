<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::create(
            [
                'user_id'       => 1,
                'phone1'        => '9806543559',
                'address'       => 'Mohariya Tole',
                'city_id'       => 1,
                'country_id'    => 1
            ]
        );
    }
}
