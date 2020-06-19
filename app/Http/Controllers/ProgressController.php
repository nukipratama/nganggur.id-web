<?php

namespace App\Http\Controllers;

use App\Progress;
use App\Project;
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
        toast('Unggah Pengerjaan Berhasil!', 'success');
        session()->flash('home', route('home'));

        return redirect(route('project.details', ['id' => $project->id]));
    }
}
