<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Progress;
use App\Project;
use App\Notification;
use App\User;
use App\UserDetails;
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
        if ($bid->wasRecentlyCreated) {
            toast('Penawaran Dibuat', 'success');
            $project = Project::find($bid->project_id);
            $user = User::where('id', $bid->user_id)->with('details')->first();
            Notification::create([
                'user_id' => $project->user_id,
                'title' => $user->name . ' tertarik pada project anda',
                'description' => $user->name . ' memberikan penawaran pada ' . $project->title,
                'icon' => $user->details->photo ? $user->details->photo : asset('img/avatar_placeholder.png'),
                'target' => route('project.details', ['id' => $project->id]),
            ]);
        } else {
            toast('Penawaran Diubah', 'success');
        }
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['id' => $project_id]));
    }
    public function pick($id)
    {
        $bid = Bid::where('id', $id)->with('project', 'user.details')->first();
        $project =  Project::where('id', $bid->project_id)->with('subtype', 'user')->first();
        $project->partner_id = $bid->user_id;
        $project->budget = $bid->budget;
        $project->duration = $bid->duration;
        $project->status_id = 1;
        $project->save();
        $progress = Progress::create([
            'title' => $bid->user->name . ' dipilih sebagai Mitra',
            'step' => 0,
            'project_id' => $bid->project_id,
        ]);
        Notification::create([
            'user_id' => $bid->user->id,
            'title' => 'Selamat, Penawaran anda berhasil!',
            'description' => $project->user->name . ' memilih anda sebagai mitra pada ' . $project->title,
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['id' => $project->id]),
        ]);
        $project->invoice = $project->budget + $project->id;
        $project->invoice = "Rp " . number_format($project->invoice, 0, ',', '.');
        Notification::create([
            'user_id' => $project->user_id,
            'title' => 'Menunggu pembayaran untuk ' . $project->title,
            'description' => 'Silahkan lakukan pembayaran senilai ' . $project->invoice . ' untuk ' . $project->title . '. Klik untuk lebih lanjut.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['id' => $project->id]),
        ]);
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['id' => $bid->project->id]));
    }

    public function delete($id)
    {
    }
}
