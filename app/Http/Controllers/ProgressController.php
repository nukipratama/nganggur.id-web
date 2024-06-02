<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Progress;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Redirect;

class ProgressController extends Controller
{
    public function form(Project $project)
    {
        session()->flash('home', route('home.index'));
        return view('project.partner.progressForm', compact('project'));
    }
    public function post(Request $request, Project $project)
    {
        $project->load('progress');
        if ($project->partner_id !== auth()->id()) {
            return Redirect::home();
        }
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $attachment = [];
        $step =  $project->progress->first()->step + 1;
        if ($request->file('attachment')) {
            foreach ($request->file('attachment') as $file) {
                if ($file->isValid()) {
                    $file_mod_name = $file->getClientOriginalName();
                    $file_path = 'upload/project/' . $project->id . '/progress/' . $step . '/';
                    $file->move($file_path, $file_mod_name);
                    $path = config('app.url') . '/' . $file_path . $file_mod_name;
                    array_push($attachment, $path);
                }
            }
        }
        $progress = Progress::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'step' => $step,
            'project_id' => $project->id,
            'attachment' => json_encode($attachment),
        ]);
        $partner = User::where('id', $project->partner_id)->with('details')->first();
        Notification::create([
            'user_id' => $project->user_id,
            'title' => $partner->name . ' menambahkan ' . $progress->title,
            'description' => $partner->name . ' menggunggah pengerjaan pada ' . $project->title . '. Klik untuk melihat.',
            'icon' => $partner->details->photo ? $partner->details->photo : asset('img/avatar_placeholder.png'),
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        toast('Unggah Pengerjaan Berhasil!', 'success');
        session()->flash('home', route('home.index'));
        return redirect(route('project.details', ['project' => $project->id]));
    }
    public function verify(Project $project, Progress $progress)
    {
        $project->load('subtype');
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        $progress->verified_at = now();
        $progress->save();
        Notification::create([
            'user_id' => $project->partner_id,
            'title' => 'Pengerjaan ' . $progress->title . ' telah diterima',
            'description' => 'Selamat, pengerjaan ' . $progress->title . ' pada ' . $project->title . ' telah diterima oleh pemilik project.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        session()->flash('home', route('home.index'));
        toast('Pengerjaan ' . $progress->title . ' diterima', 'success');
        return redirect(route('project.details', ['project' => $project->id]));
    }
    public function refuse(Project $project, Progress $progress)
    {
        $project->load('subtype');
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        $progress->refused_at = now();
        $progress->save();
        Notification::create([
            'user_id' => $project->partner_id,
            'title' =>  'Pengerjaan ' . $progress->title . ' telah ditolak',
            'description' => 'Maaf, pengerjaan ' . $progress->title . ' pada ' . $project->title . ' telah ditolak oleh pemilik project.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        session()->flash('home', route('home.index'));
        toast('Pengerjaan ' . $progress->title . ' ditolak', 'info');
        return redirect(route('project.details', ['project' => $project->id]));
    }
}
