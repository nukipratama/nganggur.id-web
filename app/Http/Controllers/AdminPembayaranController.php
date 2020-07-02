<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Payment;
use App\Project;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function terima(Project $project)
    {
        $project->load('subtype');
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
        return redirect()->back();
    }
    public function tolak(Project $project)
    {
        $project->load('subtype');
        $project->status_id = 1;
        $project->save();
        Notification::create([
            'user_id' => $project->user_id,
            'title' => 'Pembayaran anda ditolak',
            'description' => 'Pembayaran untuk ' . $project->title . ' ditolak. Silahkan lakukan pembayaran sesuai dengan instruksi pembayaran.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        Payment::where('project_id', $project->id)->delete();
        return redirect()->back();
    }
}
