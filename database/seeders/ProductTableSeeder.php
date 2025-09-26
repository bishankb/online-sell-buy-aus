<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(
            [
                'category_id' => 1,
                'sub_category_id'  => 1,
                'title' => 'Honda CB 500',
                'slug' => Str::slug('Honda CB 500'),
                'description' => 'Good Bike',
                'price' => 3500,
                'condition_type' => 1,
                'is_negotiable' => 1,
                'expiry_period' => '2025-05-07',
                'expiry_period_type' => 1,
                'features'  => '300CC. Dual Engine',
                'is_sold' => 0,
                'is_featured' => 0,
                'status' => 1,
                'manufacturer' => 'Honda',
                'usedFor_period' => 5,
                'usedFor_period_type' => 1,
                'warranty_type' => 1,
                'warranty_period' => 2.5,
                'warranty_period_type' => 1,
                'kilometer_run' => 15000,
                'make_year' => 2015,
                'color' => 'red',
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Product::create(
            [
                'category_id' => 1,
                'sub_category_id'  => 2,
                'title' => 'Mazda 3',
                'slug' => Str::slug('Mazda 3'),
                'description' => 'Good Bike',
                'price' => 5000,
                'condition_type' => 1,
                'is_negotiable' => 1,
                'expiry_period' => '2025-05-07',
                'expiry_period_type' => 1,
                'features'  => 'New Condition.',
                'is_sold' => 0,
                'is_featured' => 1,
                'status' => 1,
                'manufacturer' => 'Suzuki',
                'usedFor_period' => 5,
                'usedFor_period_type' => 1,
                'warranty_type' => 1,
                'warranty_period' => 2.5,
                'warranty_period_type' => 1,
                'kilometer_run' => 100000,
                'make_year' => 2015,
                'color' => 'white',
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Product::create(
            [
                'category_id' => 9,
                'sub_category_id'  => 107,
                'title' => 'Iphone 16 pro max',
                'slug' => Str::slug('Iphone 16 pro max'),
                'description' => 'Good Mobile',
                'price' => 1200,
                'condition_type' => 1,
                'is_negotiable' => 1,
                'expiry_period' => '2025-05-07',
                'expiry_period_type' => 1,
                'features'  => 'New Condition.',
                'is_sold' => 0,
                'is_featured' => 1,
                'status' => 1,
                'manufacturer' => 'Apple',
                'usedFor_period' => 5,
                'usedFor_period_type' => 1,
                'warranty_type' => 1,
                'warranty_period' => 2.5,
                'warranty_period_type' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );
    }
}
