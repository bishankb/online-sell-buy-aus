<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BuyerQuestion;
use Illuminate\Support\Str;

class BuyerQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuyerQuestion::create(
            [
                'question_id' => 1,
                'product_id' => 1,
                'question' => 'Where is the location?',
                'asked_by' => 2,
                'answer' => 'Its in Brisbane',
                'answer2' => 'Can it be delivered?'
            ]
        );

        BuyerQuestion::create(
            [
                'question_id' => 2,
                'product_id' => 1,
                'question' => 'How much is the cost?',
                'asked_by' => 2,
                'answer' => 'Its 4500$',
                'answer2' => 'Is it negotiable?'
            ]
        );


        BuyerQuestion::create(
            [
                'question_id' => 3,
                'product_id' => 1,
                'question' => 'Is it brand new?',
                'asked_by' => 2
            ]
        );

        BuyerQuestion::create(
            [
                'question_id' => 4,
                'product_id' => 2,
                'question' => 'Is it new?',
                'asked_by' => 2
            ]
        );
    }
}
