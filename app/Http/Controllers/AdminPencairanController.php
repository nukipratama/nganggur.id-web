<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Project;
use Illuminate\Http\Request;

class AdminPencairanController extends Controller
{
    public function terima(Project $project)
    {
        $project->load('subtype');
        $project->withdraw_verified_at = now();
        $project->save();
        Notification::create([
            'user_id' => $project->partner_id,
            'title' => 'Pencairan Dana Berhasil',
            'description' => 'Permintaan Pencairan Dana untuk ' . $project->title . ' telah dibayar. Terima Kasih.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        return redirect()->back();
    }
    public function tolak(Project $project)
    {
        $project->load('subtype');
        $project->withdraw_at = null;
        $project->save();
        Notification::create([
            'user_id' => $project->partner_id,
            'title' => 'Pencairan Dana Gagal',
            'description' => 'Maaf, Permintaan Pencairan Dana untuk ' . $project->title . ' ditolak. Silahkan periksa kembali nomor rekening terdaftar. Terima Kasih.',
            'icon' => $project->subtype->icon,
            'target' => route('project.details', ['project' => $project->id]),
        ]);
        return redirect()->back();
    }
}
