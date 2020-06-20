<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->paginate(10);
        $read = Notification::where([['user_id', auth()->id()], ['read', 0]])->update([
            'read' => 1
        ]);
        return view('notification.index', compact('notification'));
    }
    public function unread()
    {
        $notification = Notification::where([['user_id', auth()->id()], ['read', 0]])->get();
        $read = Notification::where([['user_id', auth()->id()], ['read', 0]])->update([
            'read' => 1
        ]);
        return $notification;
    }
    public function count()
    {
        return Notification::where([['user_id', auth()->id()], ['read', 0]])->count();
    }
}
