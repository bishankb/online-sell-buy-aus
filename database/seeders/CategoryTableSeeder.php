<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Automobiles',
                'slug' => Str::slug('Automobiles'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Beauty & Health',
                'slug' => Str::slug('Beauty & Health'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );


        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Book & Stationary',
                'slug' => Str::slug('Book & Stationary'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Computer & Equipments',
                'slug' => Str::slug('Computer & Equipments'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Fashion Wear',
                'slug' => Str::slug('Fashion Wear'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Food & Drinks',
                'slug' => Str::slug('Food & Drinks'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Home Appliances',
                'slug' => Str::slug('Home Appliances'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Mobile & Accessories',
                'slug' => Str::slug('Mobile & Accessories'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Music Instruments',
                'slug' => Str::slug('Music Instruments'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Pet & Pet Care',
                'slug' => Str::slug('Pet & Pet Care'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Real State',
                'slug' => Str::slug('Real State'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Services',
                'slug' => Str::slug('Services'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Sport & Fitness',
                'slug' => Str::slug('Sport & Fitness'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Toys & Games',
                'slug' => Str::slug('Toys & Games'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Travel, Tour & Packages',
                'slug' => Str::slug('Travel, Tour & Packages'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        Category::create(
            [
                'category_for' => 'product',
                'title'  => 'Others',
                'slug' => Str::slug('Others'),
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );
    }
}
