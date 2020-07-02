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
        if (!$chat->project) {
            return Redirect::home();
        }
        $role_id = auth()->user()->role_id;
        $role = $role_id === 1 ? $chat->project->user_id : $chat->project->partner_id;
        if ($role !== auth()->id()) {
            return Redirect::home();
        }
        if ($chat->chats) {
            $data = json_decode($chat->chats);
            foreach ($data as $index => $item) {
                if ($item->user_id !== auth()->id()) {
                    $data[$index]->read = true;
                }
            }
            $chat->chats = json_encode($data);
            $chat->save();
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
                'read' => false
            ]);
            $chat->chats = json_encode($chats);
        } else {
            $chat->chats = json_encode([[
                'timestamp' => now(),
                'message' => $request->message,
                'user_id' => auth()->id(),
                'read' => false
            ]]);
        }
        $chat->save();
        return response()->json(['status' => 200]);
    }
    public function get(Project $project)
    {
        $chat = Chat::where('project_id', $project->id)->with('project')->first();
        $role = auth()->user()->role_id === 1 ? $project->user_id : $project->partner_id;
        if ($role !== auth()->id()) {
            return response()->json(['status' => 401]);
        }
        if ($chat->chats) {
            $data = json_decode($chat->chats);
            $unread = [];
            foreach ($data as $index => $item) {
                if ($item->user_id !== auth()->id()) {
                    if ($item->read === false) {
                        array_push($unread, $item);
                    }
                    $data[$index]->read = true;
                }
            }
            $chat->chats = json_encode($data);
            $chat->save();
            return response()->json([
                'status' => 200,
                'chats' => $unread
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'chats' => null
            ]);
        }
    }
}
