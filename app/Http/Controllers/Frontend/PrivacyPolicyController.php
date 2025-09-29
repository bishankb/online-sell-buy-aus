<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

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
}
