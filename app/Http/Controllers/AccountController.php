<?php

namespace App\Http\Controllers;

use App\Project;
use App\SubTypes;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->with('details', 'role', 'type')->first();
        if (auth()->user()->role_id === 1) {
            $projects =  Project::where('user_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
        } else {
            $projects =  Project::where('partner_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('account.index', compact('user', 'projects'));
    }
    public function projects()
    {
        if (auth()->user()->role_id !== 1) {
            $get = Project::where('partner_id', '=', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
        } else {
            $get = Project::where('user_id', '=', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
        }
        $project = $get->groupBy('status_id');
        return view('myProject', compact('project'));
    }
    public function edit()
    {
        return view('account.editProfile');
    }
    public function password()
    {
        return 'worked';
    }
}
