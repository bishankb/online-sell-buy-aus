<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactUs;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUs::create(
            [
                'name1'       => 'Bishank Badgami',
                'name2'       => 'Sushank Badgami', 
                'phone1'      => '0431046513', 
                'phone2'      => '0431046513',
                'address'     => '10/52 Daw Road, Runcorn, 4113',
                'email'       => 'badgamib@gmail.com',
            ]
        );
    }
}
