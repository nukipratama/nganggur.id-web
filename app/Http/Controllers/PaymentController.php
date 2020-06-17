<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Project;
use Illuminate\Http\Request;
use Redirect;

class PaymentController extends Controller
{
    public function instruction(Request $request, $id)
    {
        $payment_method = $request->payment_method;
        $project =  Project::where('id', $id)->with('subtype', 'user.details', 'partner.details', 'status', 'bids.user.details')->first();
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home'));
        return view('project.pay.instruction', compact('project', 'payment_method'));
    }
    public function pay(Request $request, $id)
    {
        $payment_method = $request->payment_method;
        $project =  Project::where('id', $id)->with('subtype', 'user.details', 'partner.details', 'status', 'bids.user.details')->first();
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home'));
        return view('project.pay.pay', compact('project', 'payment_method'));
    }
    public function upload(Request $request, $id)
    {
        $request->validate([
            'receipt' => 'required|image|max:8192',
        ]);
        $receipt = $request->file('receipt');
        $file_mod_name = $receipt->getClientOriginalName();
        $file_path = 'upload/project/' . $id . '/payment/';
        $receipt->move($file_path, $file_mod_name);
        $path = config('app.url') . '/' . $file_path . $file_mod_name;
        $project = Project::find(6);
        if ($project->user_id !== auth()->id()) {
            return redirect('home');
        }
        $project->status_id = 2;
        $project->save();
        $payment = Payment::create([
            'project_id' => $project->id,
            'attachment' => $path,
        ]);
        return redirect(route('project.details', ['id' => $project->id]));
    }
}
