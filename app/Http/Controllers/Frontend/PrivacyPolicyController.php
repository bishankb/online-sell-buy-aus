<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use SEOMeta;
use OpenGraph;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seoPrivacyPolicy();

        $contact_us = ContactUs::first();
       
        return view('frontend.privacy-policy.index', compact('contact_us'));
    }

    private function seoPrivacyPolicy()
    {
        SEOMeta::setTitle('Privacy Policy -'.env('APP_NAME'));
        SEOMeta::setDescription('Privacy Policy on '.env('APP_NAME').'. View our confidential policy.');
        SEOMeta::setCanonical(route('frontend.privacy-policy'));
        SEOMeta::addKeyword(['osbaustralia', 'privacyPolicy', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Privacy Policy -'.env('APP_NAME'));
        OpenGraph::setDescription('Privacy Policy '.env('APP_NAME').'. View our confidential policy.');
        OpenGraph::setUrl(route('frontend.privacy-policy'));
    }
}
