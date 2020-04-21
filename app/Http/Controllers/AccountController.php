<?php

namespace App\Http\Controllers;

use App\Project;
use App\SubTypes;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
        return view('home', compact('user'));
    }
    public function projects()
    {
        return Project::where('user_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
    }
}
