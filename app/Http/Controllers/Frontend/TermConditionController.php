<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use SEOMeta;
use OpenGraph;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seoTermCondition();

        $contact_us = ContactUs::first();
       
        return view('frontend.term-condition.index', compact('contact_us'));
    }

    private function seoTermCondition()
    {
        SEOMeta::setTitle('Terms & Conditions -'.env('APP_NAME'));
        SEOMeta::setDescription('Terms & Condition on '.env('APP_NAME').'. Check our terms and condition for engaging in our site.');
        SEOMeta::setCanonical(route('frontend.term-condition'));
        SEOMeta::addKeyword(['osbaustralia', 'terms', 'conditions', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Terms & Conditions -'.env('APP_NAME'));
        OpenGraph::setDescription('Terms & Conditions '.env('APP_NAME').'. Check our terms and condition for engaging in our site');
        OpenGraph::setUrl(route('frontend.term-condition'));
    }
}
