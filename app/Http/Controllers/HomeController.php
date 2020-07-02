<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\UserDetails;

class HomeController extends Controller
{
    public function index()
    {
        switch (auth()->user()->role_id) {
            case 0:
                return redirect(route('admin.index'));
                break;
            case 1:
                $role = 'user_id';
                break;
            case 2:
                $role = 'partner_id';
                break;
            default:
                auth()->logout();
                return redirect('login');
                break;
        }
        $badge = collect([
            'total' => Project::where($role, auth()->id())->count(),
            'ongoing' => Project::where([[$role, auth()->id()], ['status_id', '<', '4']])->count(),
            'success' => Project::where([[$role, auth()->id()], ['status_id', '>', '3'], ['status_id', '<', '100']])->count(),
            'failed' => Project::where([[$role, auth()->id()], ['status_id', '>=', '100']])->count(),
        ]);
        $user = User::where('id', auth()->id())->with(['details', 'role', 'type'])->first();
        $user->badge = $badge;
        $myProject =  Project::where([[$role, auth()->id()], ['status_id', '<', 3]])->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->limit(3)->get();
        $recentProject =  Project::where('status_id', 0)->with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home', compact('user', 'myProject', 'recentProject'));
    }
}
