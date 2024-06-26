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
        $project->load(['subtype', 'user', 'partner', 'status', 'bids.user']);
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home.index'));
        info($project->invoice);
        return view('project.pay.instruction', compact('project', 'payment_method'));
    }
    public function pay(Request $request, Project $project)
    {
        $payment_method = $request->payment_method;
        $project->load(['subtype', 'user', 'partner', 'status', 'bids.user']);
        $project->invoice = $project->budget + $project->id;
        if ($project->user_id !== auth()->id()) {
            return Redirect::home();
        }
        session()->flash('home', route('home.index'));
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
        session()->flash('home', route('home.index'));
        toast('Berhasil unggah pembayaran project', 'success');

        if (app()->environment('testing')) {
            $project->status_id = 3;
            $project->save();
            Notification::create([
                'user_id' => $project->user_id,
                'title' => 'Pembayaran sudah diverifikasi',
                'description' => 'Pembayaran untuk ' . $project->title . ' telah diverifikasi. Klik untuk melihat.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
            Notification::create([
                'user_id' => $project->partner_id,
                'title' => $project->title . ' telah dibayar',
                'description' => $project->title . ' telah dibayar. Anda dapat mulai mengerjakan project dan mengunggah pengerjaan.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
        }
        return redirect(route('project.details', ['project' => $project->id]));
    }
    public function withdraw(Project $project)
    {
        $project->load('subtype');
        $project->withdraw_at = now();
        $project->save();
        Notification::create([
            'user_id' => $project->partner_id,
            'title' => 'Permintaan Pencairan Dana',
            'description' => 'Permintaan Pencairan Dana untuk ' . $project->title . ' sedang diproses. Silahkan menunggu konfirmasi dari pihak Nganggur.id (maksimal 3 hari kerja).',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        toast('Berhasil meminta pencairan dana<br>Permintaan Pencairan Dana akan segera diproses', 'success');
        session()->flash('home', route('home.index'));

        if (app()->environment('testing')) {
            $project->withdraw_verified_at = now();
            $project->save();
            Notification::create([
                'user_id' => $project->partner_id,
                'title' => 'Pencairan Dana Berhasil',
                'description' => 'Permintaan Pencairan Dana untuk ' . $project->title . ' telah dibayar. Terima Kasih.',
                'icon' => $project->subtype->icon,
                'target' => route('project.details', ['project' => $project->id]),
            ]);
        }

        return redirect(route('project.details', ['project' => $project->id]));
    }
}
