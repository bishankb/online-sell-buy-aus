<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(
            [
                'name'  => 'Pokhara',
                'order' => 1, 
            ]
        );

        City::create(
            [
                'name'  => 'Kathmandu',
                'order' => 2, 
            ]
        );

        City::create(
            [
                'name'  => 'Bara',
                'order' => 3, 
            ]
        );
    }
}
