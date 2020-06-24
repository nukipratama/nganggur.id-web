<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Redirect;

class ChatController extends Controller
{
    public function index()
    {

        // return view('chat.index');
    }
    public function room($project_id)
    {
        $chat = Chat::firstOrCreate(['project_id' => $project_id]);
        $chat = Chat::where('project_id', $project_id)->with('project')->first();
        if (!$chat->project) {
            return Redirect::home();
        }
        $role_id = auth()->user()->role_id;
        $role = $role_id === 1 ? $chat->project->user_id : $chat->project->partner_id;
        if ($role !== auth()->id()) {
            return Redirect::home();
        }
        //logika untuk chat
        //nama yg dichat
        $chat->name = $role !== 1 ? User::where('id', $chat->project->user_id)->first() : User::where('id', $chat->project->partner_id)->first();
        session()->flash('home', route('home'));
        return view('chat.room', compact('chat'));
    }
}
