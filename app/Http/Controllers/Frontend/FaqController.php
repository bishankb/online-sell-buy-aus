<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use SEOMeta;
use OpenGraph;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seoFaq();

        $faqs = Faq::where('status', 1)->paginate(config('product.faq_paginate'));
        
        return view('frontend.faq.index', compact('faqs'));
    }

    private function seoFaq()
    {
        SEOMeta::setTitle('FAQ -'.env('APP_NAME'));
        SEOMeta::setDescription('Frequently Ask Questions on '.env('APP_NAME').'. Fee to free to contact us if any problems');
        SEOMeta::setCanonical(route('frontend.faq'));
        SEOMeta::addKeyword(['osbaustralia', 'faq', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('FAQs. -'.env('APP_NAME'));
        OpenGraph::setDescription('Frequently Ask Questions on '.env('APP_NAME').'. Fee to free to contact us if any problems');
        OpenGraph::setUrl(route('frontend.faq'));
    }
}
