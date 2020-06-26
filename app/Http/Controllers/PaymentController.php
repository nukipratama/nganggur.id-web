<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Payment;
use App\Progress;
use App\Project;
use Illuminate\Http\Request;
use Redirect;

class PaymentController extends Controller
{
    public function instruction(Request $request, Project $project)
    {
        $payment_method = $request->payment_method;
        $project->load(['subtype', 'user.details', 'partner.details', 'status', 'bids.user.details']);
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home'));
        return view('project.pay.instruction', compact('project', 'payment_method'));
    }
    public function pay(Request $request, Project $project)
    {
        $payment_method = $request->payment_method;
        $project->load(['subtype', 'user.details', 'partner.details', 'status', 'bids.user.details']);
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home'));
        return view('project.pay.pay', compact('project', 'payment_method'));
    }
    public function upload(Request $request, Project $project)
    {
        $request->validate([
            'receipt' => 'required|image|max:8192',
        ]);
        $receipt = $request->file('receipt');
        $file_mod_name = $receipt->getClientOriginalName();
        $file_path = 'upload/project/' . $project->id . '/payment/';
        $receipt->move($file_path, $file_mod_name);
        $path = config('app.url') . '/' . $file_path . $file_mod_name;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        $project->status_id = 2;
        $project->save();
        Payment::create([
            'project_id' => $project->id,
            'attachment' => $path,
        ]);
        Progress::create([
            'title' => 'Project dibayar',
            'description' => 'Menunggu Verifikasi Pembayaran',
            'step' => 0,
            'project_id' => $project->id,
        ]);
        Notification::create([
            'user_id' => $project->user_id,
            'title' => 'Pembayaran sedang diverifikasi',
            'description' => 'Terima Kasih telah melakukan pembayaran untuk ' . $project->title . '. Silahkan menunggu pembayaran diverifikasi untuk melanjutkan.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        session()->flash('home', route('home'));
        return redirect(route('project.details', ['project' => $project->id]));
    }
}
