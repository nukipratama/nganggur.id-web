<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {

        $recentProject = Project::with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->paginate(5);
        if ($recentProject->currentPage() > $recentProject->lastPage()) {
            return redirect('projects');
        }
        return view('projects', compact('recentProject'));
    }
}
