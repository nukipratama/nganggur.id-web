<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function form($id)
    {
        return 'form' . $id;
    }
}
