<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
        return view('home', compact('user'));
    }
}
