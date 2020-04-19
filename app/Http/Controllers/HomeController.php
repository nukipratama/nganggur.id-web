<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\UserDetails;

class HomeController extends Controller
{
    public function index()
    {
        $badge['total'] =  Project::where('user_id', auth()->id())->count();
        $badge['ongoing'] =  Project::where([['user_id', '=', auth()->id()], ['status_id', '<', '4']])->count();
        $badge['success'] =  Project::where([['user_id', '=', auth()->id()], ['status_id', '>', '3'], ['status_id', '<', '100']])->count();
        $badge['failed'] =  Project::where([['user_id', '=', auth()->id()], ['status_id', '>=', '100']])->count();
        $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
        $user->badge = $badge;
        $myProject =  Project::where('user_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->first();
        $recentProject =  Project::with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->first();
        return view('home', compact('user', 'myProject', 'recentProject'));
    }
}
