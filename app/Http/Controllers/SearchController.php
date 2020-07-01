<?php

namespace App\Http\Controllers;

use App\Project;
use App\Type;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $recentProject = Project::where('status_id', 0)->with('subtype', 'user.details', 'status')->orderBy('created_at', 'DESC')->paginate(5);
        $types = Type::all();
        return view('projects', compact('recentProject', 'types'));
    }
    public function sorted(Request $request, $type_title)
    {
        $type = Type::with('subtypes')->where('title', $type_title)->first();
        $subtype_id = collect([]);
        foreach ($type->subtypes as $item) {
            $subtype_id->push($item->id);
        }
        $projects = Project::where('status_id', 0)->whereIn('subtype_id', $subtype_id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('projectsSorted', compact('type', 'projects'));
    }
    public function query(Request $request)
    {
        $result = collect([
            'project' => Project::where('title', 'like', '%' .  $request->input('query') . '%')->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get(),
            'pelanggan' => User::where([['name', 'like', '%' . $request->input('query') . '%'], ['role_id', 1]])->with('details', 'role')->get(),
            'mitra' => User::where([['name', 'like', '%' . $request->input('query') . '%'], ['role_id', 2]])->with('details', 'role', 'type')->get(),
        ]);
        $query = $request->input('query');
        return view('search.query', compact('result', 'query'));
    }
    public function more(Request $request)
    {
        $type = $request->input('type');
        $query = $request->input('query');
        switch ($type) {
            case 'Project':
                $data = Project::where('title', 'like', '%' .  $request->input('query') . '%')->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
                break;
            case 'Pelanggan':
                $data =  User::where([['name', 'like', '%' . $request->input('query') . '%'], ['role_id', 1]])->with('details', 'role')->paginate(5);
                break;
            case 'Mitra':
                $data = User::where([['name', 'like', '%' . $request->input('query') . '%'], ['role_id', 2]])->with('details', 'role', 'type')->paginate(5);
                break;
        }
        return view('search.more', compact('type', 'data', 'query'));
    }
}
