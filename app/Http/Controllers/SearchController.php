<?php

namespace App\Http\Controllers;

use App\Project;
use App\Type;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $recentProject = Project::with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->paginate(5);
        $types = Type::all();
        if (!$recentProject->items()) {
            return redirect('projects');
        }
        return view('projects', compact('recentProject', 'types'));
    }
    public function sorted(Request $request, $type_title)
    {
        $type = Type::with('subtypes')->where('title', $type_title)->first();
        if (!$type) {
            return redirect('projects');
        }
        $subtype_id = collect([]);
        foreach ($type->subtypes as $item) {
            $subtype_id->push($item->id);
        }
        $projects = Project::whereIn('subtype_id', $subtype_id)->orderBy('created_at', 'DESC')->paginate(5);
        if (!$projects->items()) {
            return redirect('projects/' . $type_title);
        }
        return view('projectsSorted', compact('type', 'projects'));
    }
}
