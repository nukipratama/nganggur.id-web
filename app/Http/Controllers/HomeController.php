<?php

namespace App\Http\Controllers;

use App\Project;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect(route('admin.index'));
        }

        $user->load(['details', 'role', 'type']);

        $myProject = Project::query()
            ->with(['subtype',  'user.details', 'status', 'partner'])
            ->whereUser($user)
            ->statusOngoing()
            ->latest('created_at')
            ->limit(3)
            ->get();

        $recentProject = Project::query()
            ->with(['subtype', 'user.details', 'status'])
            ->statusNew()
            ->latest()
            ->limit(3)
            ->get();

        return view('home', [
            'user' => $user,
            'myProject' => $myProject,
            'recentProject' => $recentProject,
            'projectCount' => Project::getCounterByUser($user),
        ]);
    }
}
