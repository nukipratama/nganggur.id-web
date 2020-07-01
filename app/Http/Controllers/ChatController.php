<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Redirect;

class ChatController extends Controller
{
    public function index()
    {

        // return view('chat.index');
    }
    public function room(Project $project)
    {
        $chat = Chat::firstOrCreate(['project_id' => $project->id]);
        $chat = Chat::where('project_id', $project->id)->with('project')->first();

        //check hak akses halaman
        if (!$chat->project) {
            return Redirect::home();
        }
        $role_id = auth()->user()->role_id;
        $role = $role_id === 1 ? $chat->project->user_id : $chat->project->partner_id;
        if ($role !== auth()->id()) {
            return Redirect::home();
        }
        $chat->name = $role !== 1 ? User::where('id', $chat->project->user_id)->first() : User::where('id', $chat->project->partner_id)->first();
        session()->flash('home', route('home'));
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if ($pageWasRefreshed) {
            session()->flash('chat', route('chat.index'));
        }
        return view('chat.room', compact('chat'));
    }
    public function send(Request $request, Project $project)
    {
        $chat = Chat::where('project_id', $project->id)->with('project')->first();
        $role = auth()->user()->role_id === 1 ? $project->user_id : $project->partner_id;
        if ($role !== auth()->id()) {
            return response()->json(['status' => 401]);
        }
        if ($chat->chats) {
            $chats = json_decode($chat->chats, true);
            array_push($chats, [
                'timestamp' => now(),
                'message' => $request->message,
                'user_id' => auth()->id(),
            ]);
            $chat->chats = json_encode($chats);
        } else {
            $chat->chats = json_encode([[
                'timestamp' => now(),
                'message' => $request->message,
                'user_id' => auth()->id(),
            ]]);
        }
        $chat->save();
        return response()->json(['status' => 200]);
    }
    public function get(Project $project)
    {
        $chat = Chat::where('project_id', $project->id)->with('project')->first();
        if ($project->user_id !== auth()->id() || $project->partner_id !== auth()->id()) {
            return response()->json(['status' => 401]);
        }
        $data = $chat->chats ? json_decode($chat->chats, true) : [];
        return response()->json([
            'status' => 200,
            'chats' => $data
        ]);
    }
}
