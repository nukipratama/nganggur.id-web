<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\UserDetails;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id === 1) {
            $badge = collect([
                'total' => Project::where('user_id', auth()->id())->count(),
                'ongoing' => Project::where([['user_id', '=', auth()->id()], ['status_id', '=', '3']])->count(),
                'success' => Project::where([['user_id', '=', auth()->id()], ['status_id', '>', '3'], ['status_id', '<', '100']])->count(),
                'failed' => Project::where([['user_id', '=', auth()->id()], ['status_id', '>=', '100']])->count(),
            ]);
            $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
            $user->badge = $badge;
            $myProject =  Project::where('user_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->first();
        } else {
            $badge = collect([
                'total' => Project::where('partner_id', auth()->id())->count(),
                'ongoing' => Project::where([['partner_id', '=', auth()->id()], ['status_id', '=', '3']])->count(),
                'success' => Project::where([['partner_id', '=', auth()->id()], ['status_id', '>', '3'], ['status_id', '<', '100']])->count(),
                'failed' => Project::where([['partner_id', '=', auth()->id()], ['status_id', '>=', '100']])->count(),
            ]);
            $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
            $user->badge = $badge;
            $myProject =  Project::where('partner_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->first();
        }
        $recentProject =  Project::with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->first();
        return view('home', compact('user', 'myProject', 'recentProject'));
    }
}
