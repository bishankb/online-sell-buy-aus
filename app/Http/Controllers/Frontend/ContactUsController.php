<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ContactUs;
use App\Notifications\ViewerMailNotification;
use Illuminate\Support\Facades\Notification;
use SEOMeta;
use OpenGraph;

class ContactUsController extends Controller
{
    public function index()
    {
        $this->seoContact();

        $contact_us = ContactUs::first();

        return view('frontend.contact-us.index', compact('contact_us'));
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|min:2|max:255', 
            'email'   => 'required|email|min:2|max:255', 
            'phone'   => 'min:5|max:20|nullable', 
            'subject' => 'required|min:2|max:255', 
            'message' => 'required|min:5|max:255', 
        ]);

        try {
            $admin = User::where('email', env('APP_EMAIL'))->first();

            $viewerData = [
                'name'    => request('name'),
                'email'   => request('email'),
                'phone'   => request('phone'),
                'subject' => request('subject'),
                'message' => request('message'),
            ];

            Notification::send($admin, new ViewerMailNotification($viewerData));

            $notification = array(
                'success'    => 'Message sent successfully. Please wait for response.',
            );

        } catch (Exception $e) {
            logger()->error($exception->getMessage());
            
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            ); 
        }

        return redirect()->route('contact-us.index')->with($notification);
    }

    private function seoContact()
    {
        SEOMeta::setTitle('Contact Us -'.env('APP_NAME'));
        SEOMeta::setDescription('Contact us if you have any querries on '.env('APP_NAME').'. You can call us, mail us and submit your feedback or meesages through the form');
        SEOMeta::setCanonical(route('contact-us.index'));
        SEOMeta::addKeyword(['osbaustralia', 'contact', 'number', 'mail', 'form', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Contact us if you have any querries. -'.env('APP_NAME'));
        OpenGraph::setDescription('Contact us if you have any querries on '.env('APP_NAME').'. You can call us, mail us and submit your feedback or meesages through the form');
        OpenGraph::setUrl(route('contact-us.index'));
    }
}
