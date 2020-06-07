<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Project;
use App\SubTypes;
use App\Type;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;

class ProjectController extends Controller
{
    public function details($id)
    {
        $project =  Project::where('id', $id)->with('subtype', 'user.details', 'partner.details', 'status', 'bids.user.details')->first();
        $project->views++;
        $project->save();
        $project->canBid = false;
        $project->canUpdate = false;
        if ($project->subtype->type_id === auth()->user()->type_id && $project->status_id === 0) {
            $bid = Bid::where([['user_id', '=', auth()->id()], ['project_id', '=', $project->id]])->first();
            if ($bid) {
                $project->canBid = false;
                $project->canUpdate = true;
                $project->bid_id = $bid->id;
            } else {
                $project->canBid = true;
                $project->canUpdate = false;
            }
        }

        return view('project.details', compact('project'));
    }
    public function bid($id)
    {
        $bid = Bid::where('id', $id)->with('project', 'user.details')->first();
        if (auth()->id() === $bid->project->user_id) {
            return view('project.bid', compact('bid'));
        } else {
            return redirect(route('project.details', ['id' => $bid->project->id]));
        }
    }
    public function bidForm($project_id)
    {
        $bid = Bid::where([['user_id', '=', auth()->id()], ['project_id', '=', $project_id]])->first();
        $project =  Project::where('id', $project_id)->with('subtype', 'user.details', 'status', 'bids.user.details')->first();
        return view('project.partner.bidForm', compact('project', 'bid'));
    }
    public function bidPost(Request $request, $project_id)
    {
        $request->validate([
            'duration' => 'required|numeric|min:1|max:365',
            'budget' => 'required|numeric',
            'message' => 'required|string',
        ]);
        $bid = Bid::updateOrCreate(
            ['project_id' => $project_id, 'user_id' => auth()->id()],
            [
                'message' => $request->message,
                'duration' => $request->duration,
                'budget' => $request->budget,
            ]
        );
        return redirect(route('project.details', ['id' => $project_id]));
    }
    public function bidPick($id)
    {
        $bid = Bid::where('id', $id)->with('project', 'user.details')->first();
        $project =  Project::where('id', $bid->project_id)->update([
            'partner_id' => $bid->user_id,
            'budget' => $bid->budget,
            'duration' => $bid->duration,
            'status_id' => 1,
        ]);
        return redirect(route('project.details', ['id' => $bid->project->id]));
    }
    public function bidEdit($bid_id)
    {

        $bid = Bid::where('id', $bid_id)->first();
        $project =  Project::where('id', $bid->project_id)->with('subtype', 'user.details', 'status', 'bids.user.details')->first();
        return view('project.partner.bidForm', compact('project', 'bid'));
    }
    public function bidDelete($id)
    {
    }
    public function type()
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
        $type = Type::all();
        return view('project.type', compact('type'));
    }
    public function subtype($type_id)
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
        $subtype = SubTypes::where('type_id', $type_id)->get();
        if ($subtype->isEmpty()) {
            return redirect(route('project.create'));
        }
        return view('project.subtype', compact('subtype'));
    }
    public function form($subtype_id)
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
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
        $project = Project::create($data);
        toast('Project ' . $request->title . ' dibuat', 'success');
        return redirect(route('project.details', ['id' => $project->id]));
    }
    public function edit($id)
    {
        return 'Project id:' . $id;
    }
    public function update(Request $request)
    {
        return $request;
    }
    public function delete($id)
    {
        toast('Project ' . $id . ' terhapus', 'success');
        return Redirect::home();
    }
}
