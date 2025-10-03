<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BuyerQuestion;
use App\Models\User;
use Auth;

class BuyerQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readMore($productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $buyer_questions = BuyerQuestion::where('product_id', $product->id)
                                        ->latest()
                                        ->paginate(config('product.buyer_question_paginate'));
        
        return view('frontend.product-section.buyer-question', compact('buyer_questions', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::where('slug', request('product_slug'))
                            ->where('created_by', '!=', Auth::user()->id)
                            ->firstOrFail();

        $this->validate($request, [
            'question'     => 'required|min:2|max:255', 
        ]);

        try {
            $buyer_question = BuyerQuestion::create([
                'question_id' => $this->generateRandomNumber(),
                'product_id'  => $product->id,
                'question'    => request('question'),
                'asked_by'    => Auth::user()->id
            ]);

            $notification = array(
                'success'    => 'Your query has been submitted. You will be notified by the seller later.',
            );

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('product.show', $product->slug)->with($notification);
    }

    /**
     * Generate Random Number.
     *
    */
    private function generateRandomNumber() {
        $number = mt_rand(10000, mt_getrandmax());

        if ($this->randomNumberExists($number) && $number > $number + 23) {
            return generateRandomNumber();
        }

        return $number;
    }

    private function randomNumberExists($number) {
        return BuyerQuestion::where('question_id', $number)->exists();
    }
}
