<?php

namespace App\Http\Controllers;

use App\Project;
use App\SubTypes;
use App\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function type()
    {
        $type = Type::all();
        return view('project.type', compact('type'));
    }
    public function subtype($type_id)
    {
        $subtype = SubTypes::where('type_id', $type_id)->get();
        if ($subtype->isEmpty()) {
            return redirect(route('project.create'));
        }
        return view('project.subtype', compact('subtype'));
    }
    public function form($subtype_id)
    {
        $subtype = SubTypes::where('id', $subtype_id)->first();
        if (!$subtype) {
            return redirect(route('project.create'));
        }
        return view('project.form', compact('subtype'));
    }
    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4|max:100',
            'duration' => 'required|numeric|min:1|max:365',
            'budget' => 'required|numeric',
            'description' => 'required|string',
        ]);
        $data = request()->all();
        $data['user_id'] = auth()->id();
        return Project::create($data);
    }
}
