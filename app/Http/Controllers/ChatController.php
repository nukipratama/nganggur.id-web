<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {

        return view('chat.index');
    }
}
