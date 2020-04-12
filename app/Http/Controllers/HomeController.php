<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->with(['details', 'role'])->first();
        return view('home', compact('user'));
    }
}
