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
                'name'  => 'Brisbane',
                'order' => 1, 
            ]
        );

        City::create(
            [
                'name'  => 'Sydney',
                'order' => 2, 
            ]
        );

        City::create(
            [
                'name'  => 'Melbourne',
                'order' => 3, 
            ]
        );

        City::create(
            [
                'name'  => 'Perth',
                'order' => 4, 
            ]
        );

        City::create(
            [
                'name'  => 'Adelaide',
                'order' => 5, 
            ]
        );

        City::create(
            [
                'name'  => 'Hobart',
                'order' => 6, 
            ]
        );

        City::create(
            [
                'name'  => 'Darwin',
                'order' => 7, 
            ]
        );

        City::create(
            [
                'name'  => 'Canberra',
                'order' => 8, 
            ]
        );

        City::create(
            [
                'name'  => 'Other',
                'order' => 9, 
            ]
        );
    }
}
