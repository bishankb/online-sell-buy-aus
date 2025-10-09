<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\BuyerQuestion;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use App\Notifications\SellerAnswerNotification;
use DB;

class BuyerQuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_buyer_questions', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_buyer_questions', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_buyer_questions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_buyer_questions', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $buyer_questions = BuyerQuestion::categoryFilter(request('category'))
                                        ->subCategoryFilter(request('sub_category'))
                                        ->buyerQuestionSearch(request('search-item'))
                                        ->latest()
                                        ->paginate(config('product.table_paginate'));

        $categories = Category::select('title', 'slug')->get();
        $sub_categories = SubCategory::select('title', 'slug')->get();

        return view('backend.buyer-question.index', compact('buyer_questions', 'categories', 'sub_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply($question_id)
    {
        if(request('notify_id')) {
            DB::table('notifications')->where('id', request('notify_id'))->where('read_at', null)->update(['read_at' => now()]);
        } 
            
        $buyer_question = BuyerQuestion::where('question_id', $question_id)->firstOrFail();

        return view('backend.buyer-question.reply', compact('buyer_question'));
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
        $buyer_question = BuyerQuestion::where('question_id', $question_id)->firstOrFail();

        $this->validate($request, [
            'answer2'  => 'nullable|min:2|max:256',
        ]);

        try {
            $buyer_question->update([
                'answer2' => request('answer2'),
                'is_read' => 0
            ]);

            $admin = User::where('email', env('APP_EMAIL'))->first();

            $buyerData = [
                'seller_name'   => $admin->name,
                'buyer_name'    => $buyer_question->askedBy->name,
                'buyer_id'      => $buyer_question->askedBy->id,
                'product_title' => $buyer_question->product->title,
                'question'      => $buyer_question->question,
                'answer'        => request('answer'),
                'question_id'   => $question_id,
                'seller_type'   => 'admin',
                'product_slug'  => $buyer_question->product->slug 
            ];
            
            $buyer_question->askedBy->notify(new SellerAnswerNotification($buyerData));

           flash('Your answer has been submitted to the buyer.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            
            flash('There was some intenal error while submitting the answer.')->error();
        }
        return redirect()->route('buyer-questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        $buyer_question = BuyerQuestion::where('question_id', $question_id)->firstOrFail();

        return view('backend.buyer-question.edit', compact('buyer_question'));
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
        $buyer_question = BuyerQuestion::where('question_id', $question_id)->firstOrFail();

        $this->validate($request, [
            'question' => 'required|min:2|max:256',
            'answer'   => 'nullable|min:2|max:256',
            'answer2'  => 'nullable|min:2|max:256',
        ]);

        try {
            if(empty($request->answer)) {
                $this->deleteSellerNotification($question_id, 'seller');
            }

            if(empty($request->answer2)) {
                $this->deleteSellerNotification($question_id, 'admin');
            }

            if(empty($request->answer)) {
                $this->deleteSellerNotification($question_id, 'seller');
            }

            if(empty($request->answer2)) {
                $this->deleteSellerNotification($question_id, 'admin');
            }

            $buyer_question->update([
                'question' => request('question'),
                'answer'   => request('answer'),
                'answer2'  => request('answer2'),
            ]);

           flash('Buyer question updated successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            
            flash('There was some intenal error while updating the buyer question.')->error();
        }

        return redirect()->route('buyer-questions.index');
    }

    /**
     * Remove the notification based on the sellerType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function deleteSellerNotification($question_id, $seller_type) {
        try {
            $notifications = DB::table('notifications')->where('type', 'App\Notifications\SellerAnswerNotification')->get();

            $new_notificationsIds = [];

            foreach ($notifications as $key => $notification) {
                if(isset(json_decode($notification->data)->question_id) && isset(json_decode($notification->data)->seller_type)) {
                    if(json_decode($notification->data)->question_id == $question_id && json_decode($notification->data)->seller_type == $seller_type) {
                        array_push($new_notificationsIds, $notification->id);
                    }
                }
            }

            DB::table('notifications')->where('type', 'App\Notifications\SellerAnswerNotification')->whereIn('id', $new_notificationsIds)->delete();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        $buyer_question = BuyerQuestion::where('question_id', $question_id)->firstOrFail();

        try {
            $notifications =  DB::table('notifications')->get();

            $new_notificationsIds = [];

            foreach ($notifications as $key => $notification) {
                if(isset(json_decode($notification->data)->question_id)) {
                    if(json_decode($notification->data)->question_id == $question_id) {
                        array_push($new_notificationsIds, $notification->id);
                    }
                }
            }

            DB::table('notifications')->whereIn('id', $new_notificationsIds)->delete();
            $buyer_question->delete();
           
            flash('Buyer question deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the buyer question.')->error();
        }

        return redirect()->route('buyer-questions.index');
    }
}

