<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class RuleTipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seoRuleTip();
       
        $contact_us = ContactUs::first();
        
        return view('frontend.rule-tip.index', compact('contact_us'));
    }
}
