<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Notification;
use App\Payment;
use App\Progress;
use App\Project;
use App\SubTypes;
use App\Type;
use Illuminate\Http\Request;
use Redirect;

class ProjectController extends Controller
{
    public function details(Project $project)
    {
        $project->load(['subtype', 'user', 'partner', 'status', 'bids.user', 'payment', 'progress']);
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
        $project->invoice = $project->budget + $project->id;
        $project->withdraw = collect([
            'fee' => '5% dari Harga Project',
            'fee_nominal' => $project->budget * 0.05,
            'nominal' => $project->budget - ($project->budget * 0.05)
        ]);
        return view('project.details', compact('project'));
    }
    public function type()
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
        $type = Type::all();
        return view('project.type', compact('type'));
    }
    public function subtype(Type $type)
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
        $subtype = SubTypes::where('type_id', $type->id)->get();
        if ($subtype->isEmpty()) {
            return redirect(route('project.create'));
        }
        return view('project.subtype', compact('subtype'));
    }
    public function form(SubTypes $subtype)
    {
        if (auth()->user()->role_id !== 1) {
            return redirect(route('home'));
        }
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
        $check = Project::find($request->id);
        if ($check && $check->status_id > 0) {
            $data = [
                'title' => $request->title,
                'subtype_id' => $request->subtype_id,
                'description' => $request->description,
            ];
        } else {
            $data = $request->all();
        }
        $project = Project::updateOrCreate(
            ['id' => $request->id, 'user_id' => auth()->id()],
            $data
        );
        if ($project->wasRecentlyCreated) {
            Notification::create([
                'user_id' => $project->user_id,
                'title' => 'Project berhasil dibuat',
                'description' => $project->title . ' telah berhasil dibuat. Klik untuk melihat.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
            toast('Project ' . $request->title . ' dibuat', 'success');
        } else {
            toast('Project ' . $request->title . ' diubah', 'success');
        }
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['project' => $project->id]));
    }
    public function edit(Project $project)
    {
        $project->load('subtype');
        $subtype = $project->subtype;
        session()->flash('home', route('home'));
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        return view('project.form', compact('project', 'subtype'));
    }
    public function delete(Project $project)
    {
        if ($project->user_id === auth()->id()) {
            $project->delete();
            toast('Project ' . $project->title . ' terhapus', 'success');
        }
        return Redirect::home();
    }
    public function finish(Project $project)
    {
        $role = auth()->user()->role_id;
        $project->load(['progress', 'subtype', 'user', 'partner']);
        $checkAuth = $role === 1 ? $project->user_id === auth()->id() : $project->partner_id === auth()->id();
        if (!$checkAuth) {
            return Redirect::home();
        }
        //check apakah ada progress yg sudah diterima
        $checkProgress = false;
        foreach ($project->progress as $item) {
            if ($item->verified_at && $item->step !== 0) {
                $checkProgress = true;
                break;
            }
        }
        //check role karna beda logika
        if ($role === 1 && $checkProgress) {
            $project->status_id = 4;
            $project->save();
            Notification::create([
                'user_id' => $project->user_id,
                'title' => $project->title . ' telah selesai!',
                'description' => 'Selamat, ' . $project->title . ' telah ditandai selesai. Klik untuk memberikan rating pengerjaan ' . $project->partner->name . '.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
            Notification::create([
                'user_id' => $project->partner_id,
                'title' => $project->title . ' telah selesai!',
                'description' => 'Selamat, ' . $project->title . ' telah ditandai selesai. Klik untuk meminta pembayaran.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
            toast('Berhasil menyelesaikan project', 'success');
        } elseif ($role === 2 && $checkProgress) {
            $project->partner_finish = true;
            $project->save();
            Notification::create([
                'user_id' => $project->user_id,
                'title' => 'Permintaan selesai project ' . $project->title,
                'description' => $project->partner->name . ' meminta untuk menyelesaikan ' . $project->title . '. Klik untuk melihat.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
            toast('Permintaan selesai project berhasil<br>Menunggu pemilik untuk menyelesaikan project', 'success');
        } else {
            toast('Gagal menyelesaikan project<br>Tidak ada pengerjaan yang diterima', 'error');
        }
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['project' => $project->id]));
    }
}
