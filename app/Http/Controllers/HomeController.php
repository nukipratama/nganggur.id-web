<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\UserDetails;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id !== 1) {
            $role = 'partner_id';
        } else {
            $role = 'user_id';
        }
        $badge = collect([
            'total' => Project::where($role, auth()->id())->count(),
            'ongoing' => Project::where([[$role, auth()->id()], ['status_id', '<', '4']])->count(),
            'success' => Project::where([[$role, auth()->id()], ['status_id', '>', '3'], ['status_id', '<', '100']])->count(),
            'failed' => Project::where([[$role, auth()->id()], ['status_id', '>=', '100']])->count(),
        ]);
        $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
        $user->badge = $badge;
        $myProject =  Project::where($role, auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->first();
        $recentProject =  Project::with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->first();
        return view('home', compact('user', 'myProject', 'recentProject'));
    }
}
