<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $contact_us = ContactUs::first();

        return view('frontend.contact-us.index', compact('contact_us'));
    }

    public function send(Request $request)
    {
        return 'success';
    }
}
