<?php

namespace App\Http\Controllers\Frontend\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\BuyerQuestion;
use Auth;
use Carbon\Carbon;
use DB;
use App\Notifications\SellerAnswerNotification;

class BuyerQuestionController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      	$buyer_questions = BuyerQuestion::categoryFilter(request('category'))
                                          ->subCategoryFilter(request('sub_category'))
                                          ->where('asked_by', '!=', Auth::user()->id)
                                          ->whereHas('product', function ($query) {
                                              $query->where('created_by', Auth::user()->id)
                                                    ->where('status', 1)
                                                    ->where('expiry_period', '>', Carbon::now());
                                          })
                                          ->buyerQuestionSearch(request('search-item'))
                                          ->latest()
                                          ->paginate(config('product.table_paginate'));

        $categories = Category::select('title', 'slug')->get();
        $sub_categories = SubCategory::select('title', 'slug')->get();

      	return view('frontend.user-dashboard.buyer-question.index', compact('buyer_questions', 'categories', 'sub_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply($question_id)
    {
      $buyer_question = BuyerQuestion::where('question_id', $question_id)
                      ->where('asked_by', '!=', Auth::user()->id)
                      ->whereHas('product', function ($query) {
                          $query->where('created_by', Auth::user()->id)
                                  ->where('status', 1)
                                  ->where('expiry_period', '>', Carbon::now());
                      })->firstOrFail();
      
    	return view('frontend.user-dashboard.buyer-question.reply', compact('buyer_question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendReply(Request $request, $question_id)
    {
      	$buyer_question = BuyerQuestion::where('question_id', $question_id)
                      ->where('asked_by', '!=', Auth::user()->id)
                      ->whereHas('product', function ($query) {
                          $query->where('created_by', Auth::user()->id)
                                  ->where('status', 1)
                                  ->where('expiry_period', '>', Carbon::now());
                      })->firstOrFail();

        $this->validate($request, [
          'answer'  => 'nullable|min:2|max:256',
        ]);

      	try {
          	$buyer_question->update([
            	'answer' => request('answer'),
              'is_read' => 0
          	]);

            $buyerData = [
                'seller_name'   => $buyer_question->product->createdBy->name,
                'buyer_name'    => $buyer_question->askedBy->name,
                'buyer_id'      => $buyer_question->askedBy->id,
                'product_title' => $buyer_question->product->title,
                'question'      => $buyer_question->question,
                'answer'        => request('answer'),
                'question_id'   => $question_id,
                'seller_type'   => 'seller',
                'product_slug'  => $buyer_question->product->slug 
            ];
            
            $buyer_question->askedBy->notify(new SellerAnswerNotification($buyerData));

          	$notification = array(
            	'success'    => 'Your answer has been submitted. Please wait for the buyer response.',
          	);
          
          	return redirect()->route('buyer-question.index')->with($notification);

      	} catch (\Exception $exception) {
          	logger()->error($exception->getMessage());
          	$notification = array(
            	'error'    => 'Internal Error, Please try again later.',
        	);

        	return redirect()->route('buyer-question.index')->with($notification);
      	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        $buyer_question = BuyerQuestion::where('question_id', $question_id)
                                        ->where('asked_by', '!=', Auth::user()->id)
                                        ->where('answer', '!=', null)
                                        ->whereHas('product', function ($query) {
                                            $query->where('created_by', Auth::user()->id)
                                                    ->where('status', 1)
                                                    ->where('expiry_period', '>', Carbon::now());
                                        })->firstOrFail();

        return view('frontend.user-dashboard.buyer-question.edit', compact('buyer_question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question_id)
    {
        $buyer_question = BuyerQuestion::where('question_id', $question_id)
                                        ->where('asked_by', '!=', Auth::user()->id)
                                        ->where('asked_by', '!=', Auth::user()->id)
                                        ->whereHas('product', function ($query) {
                                            $query->where('created_by', Auth::user()->id)
                                                    ->where('status', 1)
                                                    ->where('expiry_period', '>', Carbon::now());
                                        })->firstOrFail();

        $this->validate($request, [
          'answer'  => 'required|min:2|max:256',
        ]);

        try {
            $buyer_question->update([
              'answer' => request('answer')
            ]);

            $notification = array(
              'success'    => 'Your answer has been updated successfully.',
            );
          
            return redirect()->route('buyer-question.index')->with($notification);

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            $notification = array(
              'error'    => 'Internal Error, Please try again later.',
          );

          return redirect()->route('buyer-question.index')->with($notification);
        }
    }
}