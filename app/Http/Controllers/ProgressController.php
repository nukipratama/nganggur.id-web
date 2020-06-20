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
    public function form($id)
    {
        $project = Project::find($id);
        session()->flash('home', route('home'));

        return view('project.partner.progressForm', compact('project'));
    }
    public function post(Request $request, $id)
    {
        $project = Project::where('id', $id)->with('progress')->first();
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
                    $file_path = 'upload/project/' . $id . '/progress/' . $step . '/';
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
        $notification = Notification::create([
            'user_id' => $project->user_id,
            'title' => $partner->name . ' menambahkan ' . $progress->title,
            'description' => $partner->name . ' menggunggah pengerjaan pada ' . $project->title . '. Klik untuk melihat.',
            'icon' => $partner->details->photo,
            'target' => route('project.details', ['id' => $project->id]),
        ]);
        toast('Unggah Pengerjaan Berhasil!', 'success');
        session()->flash('home', route('home'));

        return redirect(route('project.details', ['id' => $project->id]));
    }
}
