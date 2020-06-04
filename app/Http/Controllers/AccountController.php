<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Project;
use App\SubTypes;
use App\User;
use App\UserDetails;
use Carbon\Carbon;
use File;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->with('details', 'role', 'type')->first();
        if (auth()->user()->role_id === 1) {
            $projects =  Project::where('user_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
        } else {
            $projects =  Project::where('partner_id', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('account.index', compact('user', 'projects'));
    }
    public function projects()
    {
        if (auth()->user()->role_id !== 1) {
            $get = Project::where('partner_id', '=', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
        } else {
            $get = Project::where('user_id', '=', auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
        }
        $project = $get->groupBy('status_id');
        return view('myProject', compact('project'));
    }
    public function edit()
    {
        return view('account.editProfile');
    }
    public function put(Request $request)
    {
        $user =  User::find(auth()->id());
        $details = UserDetails::where('user_id', auth()->id())->first();
        $user->name = $request->name;
        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }
        $details->gender = $request->gender;
        $details->phone = $request->phone;
        $details->birth = $request->birth;
        $details->address = $request->address;
        $details->identity = $request->identity;
        if ($request->photo) {
            $photo = $request->file('photo');
            $file_mod_name = auth()->id() . '.' . $photo->getClientOriginalExtension();
            $file_path = 'upload/avatar/';
            $photo->move($file_path, $file_mod_name);
            $path = $file_path . $file_mod_name;
            $img = Image::make($path);
            $img->resize('400', '400');
            File::delete($path);
            $img->save($path);
            $details->photo = config('app.url') . '/' . $path;
        }
        $user->save();
        $details->save();
        return redirect(route('account.edit'));
    }
    public function password()
    {
        return view('account.changePassword');
    }
    public function passwordPut(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Kata Sandi Lama salah');
                    }
                },
            ],
            'password' => 'required|confirmed|min:8',
        ]);
        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route('account.password'));
    }
}
