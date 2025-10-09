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
                'phone1'        => '0431046513',
                'address'       => '10/52 Daw Road',
                'city_id'       => 1,
                'country_id'    => 1
            ]
        );

        UserProfile::create(
            [
                'user_id'       => 2,
                'phone1'        => '0431046513',
                'address'       => '10/52 Daw Road',
                'city_id'       => 1,
                'country_id'    => 1
            ]
        );

        UserProfile::create(
            [
                'user_id'       => 3,
                'phone1'        => '0452432345',
                'address'       => '2/5 Chester Road',
                'city_id'       => 1,
                'country_id'    => 1
            ]
        );
    }
}
