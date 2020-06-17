<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Project;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function bid($id)
    {
        $bid = Bid::where('id', $id)->with('project', 'user.details')->first();
        session()->flash('home', route('home'));

        if (auth()->id() === $bid->project->user_id) {
            return view('project.bid', compact('bid'));
        } else {
            return redirect(route('project.details', ['id' => $bid->project->id]));
        }
    }
    public function form($project_id)
    {
        $bid = Bid::where([['user_id', '=', auth()->id()], ['project_id', '=', $project_id]])->first();
        $project =  Project::where('id', $project_id)->with('subtype', 'user.details', 'status', 'bids.user.details')->first();
        session()->flash('home', route('home'));
        return view('project.partner.bidForm', compact('project', 'bid'));
    }
    public function edit($bid_id)
    {
        $bid = Bid::where('id', $bid_id)->first();
        $project =  Project::where('id', $bid->project_id)->with('subtype', 'user.details', 'status', 'bids.user.details')->first();
        session()->flash('home', route('home'));
        return view('project.partner.bidForm', compact('project', 'bid'));
    }
    public function post(Request $request, $project_id)
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
        session()->flash('home', route('home'));
        if ($bid->wasRecentlyCreated) {
            toast('Penawaran Dibuat', 'success');
        } else {
            toast('Penawaran Diubah', 'success');
        }
        return redirect(route('project.details', ['id' => $project_id]));
    }
    public function pick($id)
    {
        $bid = Bid::where('id', $id)->with('project', 'user.details')->first();
        $project =  Project::where('id', $bid->project_id)->update([
            'partner_id' => $bid->user_id,
            'budget' => $bid->budget,
            'duration' => $bid->duration,
            'status_id' => 1,
        ]);
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['id' => $bid->project->id]));
    }

    public function delete($id)
    {
    }
}
