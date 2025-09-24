<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;
use Illuminate\Support\Str;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create(
            [
                'faq' => 'How to login?',
                'answer'  => 'Go to checkpost.',
                'slug' => Str::slug('How to login?'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Faq::create(
            [
                'faq' => 'How to add product?',
                'answer'  => 'Go to add product. Add category and subcategory.',
                'slug' => Str::slug('How to add product?'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );


        Faq::create(
            [
                'faq' => 'How to filter?',
                'answer'  => 'Go to search page.',
                'slug' => Str::slug('How to filter?'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );
    }
}
