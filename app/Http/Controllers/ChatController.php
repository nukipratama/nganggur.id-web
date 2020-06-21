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
        if ($chat->project->user_id)
            return $chat;
    }
}
