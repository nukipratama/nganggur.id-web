<?php

namespace App\Http\Controllers;

use App\Project;
use App\SubTypes;
use App\Type;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function pelanggan()
    {
        $data = User::where('role_id', 1)->paginate(10);
        $data->page = 'pelanggan';
        return view('admin.index', compact('data'));
    }
    public function mitra()
    {
        $data = User::where('role_id', 2)->paginate(10);
        $data->page = 'mitra';
        return view('admin.index', compact('data'));
    }
    public function project()
    {
        $data = Project::with(['user', 'partner', 'status', 'bids', 'progress', 'payment', 'review'])->paginate(10);
        $data->page = 'project';
        return view('admin.index', compact('data'));
    }
    public function pembayaran()
    {
        $data = Project::where('status_id', 2)->with(['user', 'partner', 'status', 'bids', 'progress', 'payment', 'review'])->paginate(10);
        $data->page = 'pembayaran';
        return view('admin.index', compact('data'));
    }
    public function pencairan()
    {
        $data = Project::where([['withdraw_at', '!=', null], ['withdraw_verified_at', null]])->with(['user', 'partner', 'status', 'bids', 'progress', 'payment', 'review'])->paginate(10);
        $data->page = 'pencairan';
        return view('admin.index', compact('data'));
    }
    public function type()
    {
        $data = Type::all();
        $data2 = SubTypes::all();
        return view('admin.typeIndex', compact('data', 'data2'));
    }
}
