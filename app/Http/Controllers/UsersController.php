<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications() {

    	// Mark all as read
    	auth()->user()->unreadNotifications->markAsRead();

    	// Display all notificatios 
    	return view('users.notifications', [
    		'notifications' => auth()->user()->notifications()->paginate(5)
    	]);
    }
}
