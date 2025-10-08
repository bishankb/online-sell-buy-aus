<?php

namespace App\Http\Controllers\Frontend\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use SEOMeta;
use OpenGraph;

class NotificationController extends Controller
{
    public function viewNotification(Request $request)
    {
        $this->seoViewNotification();

        $notifications = DB::table('notifications')
            ->where('notifiable_id', Auth::user()->id)
            ->latest()
            ->paginate(config('product.table_paginate'));

        return view('frontend.user-dashboard.notification.index', compact('notifications'));
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();

            $redirectUrl = $notification->data['url'] ?? url()->previous();

            return redirect($redirectUrl);
        }

        return redirect()->back();
    }

    public function markRead()
    {
        try {
            if (Auth::user()->unreadNotifications) {
                Auth::user()->notifications->markAsRead();
            }

            $notification = array(
                'success'    => 'All notifications cleared.',
            );

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        try {
            DB::table('notifications')->where('id', $id)->delete();

            $notification = array(
                'error'    => 'Notification destroyed successfully.',
            );

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('notification.view-notification')->with($notification);
    }

    private function seoViewNotification()
    {
        SEOMeta::setTitle(Auth::user()->name."'s Notifications -".env("APP_NAME"));
        SEOMeta::setDescription(env('APP_NAME').' - View the list of your notifications, read it or delete it.');
        SEOMeta::setCanonical(route('notification.view-notification'));
        SEOMeta::addKeyword(['osbaustralia', 'notifications', 'read', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle(Auth::user()->name."'s Notifications -".env("APP_NAME"));
        OpenGraph::setDescription(env('APP_NAME').' - View the list of your notifications, read it or delete it.');
        OpenGraph::setUrl(route('notification.view-notification'));
    }
}
