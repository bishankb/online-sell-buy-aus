<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bike',
                'slug' => Str::slug('Bike'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Car',
                'slug' => Str::slug('Car'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Scooter',
                'slug' => Str::slug('Scooter'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Jeep',
                'slug' => Str::slug('Jeep'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Micro Bus',
                'slug' => Str::slug('Micro Bus'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mini Bus',
                'slug' => Str::slug('Mini Bus'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

         SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mopade',
                'slug' => Str::slug('Mopade'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Tipper',
                'slug' => Str::slug('Tipper'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Tourist Bus',
                'slug' => Str::slug('Tourist Bus'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Truck',
                'slug' => Str::slug('Truck'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Van',
                'slug' => Str::slug('Van'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Part & Accessories',
                'slug' => Str::slug('Part & Accessories'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other'),
                'category_id' => 1,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Body Care',
                'slug' => Str::slug('Body Care'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Cosmetics & Skin Care',
                'slug' => Str::slug('Cosmetics & Skin Care'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Eye Care',
                'slug' => Str::slug('Eye Care'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Face Care',
                'slug' => Str::slug('Face Care'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Medical & Health Tools',
                'slug' => Str::slug('Medical & Health Tools'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Grooming Tools',
                'slug' => Str::slug('Men Grooming Tools'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Grooming Tools',
                'slug' => Str::slug('Women Grooming Tools'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-1'),
                'category_id' => 2,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Children & School',
                'slug' => Str::slug('Children & School'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Comics & Mangas',
                'slug' => Str::slug('Comics & Mangas'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Educational Textbook',
                'slug' => Str::slug('Educational Textbook'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Interactive & Video Learning',
                'slug' => Str::slug('Interactive & Video Learning'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Magazine & Newspaper',
                'slug' => Str::slug('Magazine & Newspaper'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Novel & Biography',
                'slug' => Str::slug('Novel & Biography'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Technological Book',
                'slug' => Str::slug('Technological Book'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Stationery Items',
                'slug' => Str::slug('Stationery Items'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-2'),
                'category_id' => 3,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Desktop PC',
                'slug' => Str::slug('Desktop PC'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Desktop Accessories',
                'slug' => Str::slug('Desktop Accessories'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Graphics Card',
                'slug' => Str::slug('Graphics Card'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gamepad & Joystick',
                'slug' => Str::slug('Gamepad & Joystick'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Laptop',
                'slug' => Str::slug('Laptop'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Laptop Accessories',
                'slug' => Str::slug('Laptop Accessories'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Monitors',
                'slug' => Str::slug('Monitors'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Networking Equipments',
                'slug' => Str::slug('Networking Equipments'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Printer & Scanner',
                'slug' => Str::slug('Printer & Scanner'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Software',
                'slug' => Str::slug('Software'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Storage & Optical Devices',
                'slug' => Str::slug('Storage & Optical Devices'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'TV Card',
                'slug' => Str::slug('TV Card'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-3'),
                'category_id' => 4,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Audio Equipments',
                'slug' => Str::slug('Audio Equipments'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Video Equipments',
                'slug' => Str::slug('Video Equipments'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Camera Lens & Accesories',
                'slug' => Str::slug('Camera Lens & Accesories'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Digital Camera',
                'slug' => Str::slug('Digital Camera'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'DSLR Camera',
                'slug' => Str::slug('DSLR Camera'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Film Camera & Tape Camcorder',
                'slug' => Str::slug('Film Camera & Tape Camcorder'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Handycam',
                'slug' => Str::slug('Handycam'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Headphone & Earphone',
                'slug' => Str::slug('Headphone & Earphone'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Ipod & Mp3 Players',
                'slug' => Str::slug('Ipod & Mp3 Players'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Portable & Bluetooth Speakers',
                'slug' => Str::slug('Portable & Bluetooth Speakers'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Projectors',
                'slug' => Str::slug('Projectors'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Set-Top Box',
                'slug' => Str::slug('Set-Top Box'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Smart Box & Cast',
                'slug' => Str::slug('Smart Box & Cast'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Television',
                'slug' => Str::slug('Television'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Radio',
                'slug' => Str::slug('Radio'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Refrigerator',
                'slug' => Str::slug('Refrigerator'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-4'),
                'category_id' => 5,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Baby & Children Accesories',
                'slug' => Str::slug('Baby & Children Accesories'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Baby & Children Clothes',
                'slug' => Str::slug('Baby & Children Clothes'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bags & Luggage',
                'slug' => Str::slug('Bags & Luggage'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Jewellery',
                'slug' => Str::slug('Jewellery'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Accessories',
                'slug' => Str::slug('Men Accessories'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Clothes',
                'slug' => Str::slug('Men Clothes'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Glasses',
                'slug' => Str::slug('Men Glasses'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Shoes',
                'slug' => Str::slug('Men Shoes'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Men Watches',
                'slug' => Str::slug('Men Watches'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Accessories',
                'slug' => Str::slug('Women Accessories'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Clothes',
                'slug' => Str::slug('Women Clothes'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Glasses',
                'slug' => Str::slug('Women Glasses'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Shoes',
                'slug' => Str::slug('Women Shoes'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Women Watches',
                'slug' => Str::slug('Women Watches'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-5'),
                'category_id' => 6,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Cakes & Cookies',
                'slug' => Str::slug('Cakes & Cookies'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Cold Drinks',
                'slug' => Str::slug('Cold Drinks'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Fast Food',
                'slug' => Str::slug('Fast Food'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Grocery Items',
                'slug' => Str::slug('Grocery Items'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Home-Made Food',
                'slug' => Str::slug('Home-Made Food'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Hard Drinks',
                'slug' => Str::slug('Hard Drinks'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-6'),
                'category_id' => 7,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Antiques & Collectables',
                'slug' => Str::slug('Antiques & Collectables'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Art & Handicrafts',
                'slug' => Str::slug('Art & Handicrafts'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bathroom & Plumbing',
                'slug' => Str::slug('Bathroom & Plumbing'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Cooler & Heater',
                'slug' => Str::slug('Cooler & Heater'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Construction Materials',
                'slug' => Str::slug('Construction Materials'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gas Stove',
                'slug' => Str::slug('Gas Stove'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Home Decoration & Interiors',
                'slug' => Str::slug('Home Decoration & Interiors'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Home Furniture',
                'slug' => Str::slug('Home Furniture'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Invertor & Generator',
                'slug' => Str::slug('Invertor & Generator'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Kitchen Appliances',
                'slug' => Str::slug('Kitchen Appliances'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Kitchen Utensils',
                'slug' => Str::slug('Kitchen Utensils'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Lightning, Solars & Electrical Devices',
                'slug' => Str::slug('Lightning, Solars & Electrical Devices'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Linens & Mattress',
                'slug' => Str::slug('Linens & Mattress'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Microware oven',
                'slug' => Str::slug('Microware oven'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        
        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other Home Appliances',
                'slug' => Str::slug('Other Home Appliances'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-7'),
                'category_id' => 8,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Battery',
                'slug' => Str::slug('Battery'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Charger',
                'slug' => Str::slug('Charger'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Cover & Cases',
                'slug' => Str::slug('Cover & Cases'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Data Cables',
                'slug' => Str::slug('Data Cables'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gamepad, Triggers & Joystick',
                'slug' => Str::slug('Gamepad, Triggers & Joystick'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Headsets & Earphones',
                'slug' => Str::slug('Headsets & Earphones'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Memory Cards',
                'slug' => Str::slug('Memory Cards'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mobile Apps & Games',
                'slug' => Str::slug('Mobile Apps & Games'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mobile Handset',
                'slug' => Str::slug('Mobile Handset'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mobile Parts',
                'slug' => Str::slug('Mobile Parts'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mobile Unlock & Upgrade',
                'slug' => Str::slug('Mobile Unlock & Upgrade'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Power Bank',
                'slug' => Str::slug('Power Bank'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Screen Protector',
                'slug' => Str::slug('Screen Protector'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Selfie Monopod',
                'slug' => Str::slug('Selfie Monopod'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Smart Watch & Bands',
                'slug' => Str::slug('Smart Watch & Bands'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Ipads & Tablets',
                'slug' => Str::slug('Ipads & Tablets'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Ipads & Tablets Accessories',
                'slug' => Str::slug('Ipads & Tablets Accessories'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'VR Box',
                'slug' => Str::slug('VR Box'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-8'),
                'category_id' => 9,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Amp & Speakers',
                'slug' => Str::slug('Amp & Speakers'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'DJ Gear & Lighting',
                'slug' => Str::slug('DJ Gear & Lighting'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Drum Set',
                'slug' => Str::slug('Drum Set'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Guitars',
                'slug' => Str::slug('Guitars'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Keboard & Piano',
                'slug' => Str::slug('Keboard & Piano'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Microphones',
                'slug' => Str::slug('Microphones'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mixer & Studio Equipments',
                'slug' => Str::slug('Mixer & Studio Equipments'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-9'),
                'category_id' => 10,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Aquarium & Fish Accessories',
                'slug' => Str::slug('Aquarium & Fish Accessories'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Kennel & Dog Accessories',
                'slug' => Str::slug('Kennel & Dog Accessories'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Dogs',
                'slug' => Str::slug('Dogs'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Dog Food',
                'slug' => Str::slug('Dog Food'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Fish',
                'slug' => Str::slug('Fish'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Fish Food',
                'slug' => Str::slug('Fish Food'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other Pets',
                'slug' => Str::slug('Other Pets'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other Pet Foods',
                'slug' => Str::slug('Other Pet Foods'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Ohter Services',
                'slug' => Str::slug('Ohter Services'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-10'),
                'category_id' => 11,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Commercial Property',
                'slug' => Str::slug('Commercial Property'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Flat & Appartment - For Sale',
                'slug' => Str::slug('Flat & Appartment - For Sale'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Flat & Appartment - For Rent',
                'slug' => Str::slug('Flat & Appartment - For Rent'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'House - For Sale',
                'slug' => Str::slug('House - For Sale'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'House - For Rent',
                'slug' => Str::slug('House - For Rent'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Hotel, Lodge & Guest House - For Booking',
                'slug' => Str::slug('Hotel, Lodge & Guest House - For Booking'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Hotel, Lodge & Guest House - For Sale',
                'slug' => Str::slug('Hotel, Lodge & Guest House - For Sale'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Land - For Sale',
                'slug' => Str::slug('Land - For Sale'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Land - For Rent',
                'slug' => Str::slug('Land - For Rent'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Shutter & Shop Space - For Sale',
                'slug' => Str::slug('Shutter & Shop Space - For Sale'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Shutter & Shop Space - For Rent',
                'slug' => Str::slug('Shutter & Shop Space - For Rent'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-11'),
                'category_id' => 12,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Advertising, Printing & Publication',
                'slug' => Str::slug('Advertising, Printing & Publication'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Coaching & Tutors',
                'slug' => Str::slug('Coaching & Tutors'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Computer - Sales & Repair',
                'slug' => Str::slug('Computer - Sales & Repair'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Computer Courses',
                'slug' => Str::slug('Computer Courses'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Electronics Repair',
                'slug' => Str::slug('Electronics Repair'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Event Planner & Caterers',
                'slug' => Str::slug('Event Planner & Caterers'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Foreign Language Classes',
                'slug' => Str::slug('Foreign Language Classes'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'IELTS-GRE-TOEFEL-SAT-PTE Classes',
                'slug' => Str::slug('IELTS-GRE-TOEFEL-SAT-PTE Classes'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Home Construct & Design',
                'slug' => Str::slug('Home Construct & Design'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Home Repair & Maintainence',
                'slug' => Str::slug('Home Repair & Maintainence'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Movers Courier & Transport',
                'slug' => Str::slug('Movers Courier & Transport'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Mobile Application Devlopment',
                'slug' => Str::slug('Mobile Application Devlopment'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Music-Video-Photography',
                'slug' => Str::slug('Music-Video-Photography'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Software Design & Devlopment',
                'slug' => Str::slug('Software Design & Devlopment'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Visa Processing & Migration',
                'slug' => Str::slug('Visa Processing & Migration'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Writing-Designing-Translating',
                'slug' => Str::slug('Writing-Designing-Translating'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Web Design & Devlopment',
                'slug' => Str::slug('Web Design & Devlopment'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-12'),
                'category_id' => 13,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bicycles',
                'slug' => Str::slug('Bicycles'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bicycle Parts & Accessories',
                'slug' => Str::slug('Bicycles Parts & Accessories'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Fitness & Gym Equipment',
                'slug' => Str::slug('Fitness & Gym Equipment'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Fitness Supplements',
                'slug' => Str::slug('Fitness Supplements'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-13'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Children Toys & Dolls',
                'slug' => Str::slug('Children Toys & Dolls'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Educational Toys',
                'slug' => Str::slug('Educational Toys'),
                'category_id' => 14,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gaming Accessories',
                'slug' => Str::slug('Gaming Accessories'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gaming Console',
                'slug' => Str::slug('Gaming Console'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Gaming Disc',
                'slug' => Str::slug('Gaming Disc'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'General Toys',
                'slug' => Str::slug('General Toys'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Remote Controlled Toys',
                'slug' => Str::slug('Remote Controlled Toys'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-14'),
                'category_id' => 15,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Air Tickets',
                'slug' => Str::slug('Air Tickets'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bus Tickets',
                'slug' => Str::slug('Bus Tickets'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Bungee Jump Package',
                'slug' => Str::slug('Bungee Jump Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Canyoning Package',
                'slug' => Str::slug('Canyoning Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Day Trip & Excursion',
                'slug' => Str::slug('Day Trip & Excursion'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Hiking Package',
                'slug' => Str::slug('Hiking Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Hotel & Home Stay',
                'slug' => Str::slug('Hotel & Home Stay'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Paragliding Package',
                'slug' => Str::slug('Paragliding Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Skydiving Package',
                'slug' => Str::slug('Skydiving Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Tour Package - Domestic',
                'slug' => Str::slug('Tour Package - Domestic'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Tour Package - International',
                'slug' => Str::slug('Tour Package - International'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Trekking Package',
                'slug' => Str::slug('Trekking Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Vehicle Rental',
                'slug' => Str::slug('Vehicle Rental'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Zip Flying Package',
                'slug' => Str::slug('Zip Flying Package'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Travel Accessories',
                'slug' => Str::slug('Travel Accessories'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        SubCategory::create(
            [
                'sub_category_for' => 'product',
                'title'  => 'Other',
                'slug' => Str::slug('Other-15'),
                'category_id' => 16,
                'status' => 1,
                'home_visibility' => 0,
                'created_by' => 1,
                'updated_by' => 1
            ]
        );
    }
}
