<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(
            [
                'name'  => 'Australia',
                'order' => 1, 
            ]
        );

        Country::create(
            [
                'name'  => 'USA',
                'order' => 2, 
            ]
        );

        Country::create(
            [
                'name'  => 'UK',
                'order' => 3, 
            ]
        );

        Country::create(
            [
                'name'  => 'Canada',
                'order' => 4, 
            ]
        );

        Country::create(
            [
                'name'  => 'Nepal',
                'order' => 5, 
            ]
        );

        Country::create(
            [
                'name'  => 'India',
                'order' => 6, 
            ]
        );

        Country::create(
            [
                'name'  => 'China',
                'order' => 7, 
            ]
        );

        Country::create(
            [
                'name'  => 'Other',
                'order' => 8, 
            ]
        );
    }
}
