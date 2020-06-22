<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Project;
use App\User;
use App\UserDetails;
use File;
use Hash;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function profile($id)
    {
        if (auth()->user()->role_id !== 1) {
            $role = 'partner_id';
        } else {
            $role = 'user_id';
        }
        $badge = collect([
            'total' => Project::where($role, $id)->count(),
            'ongoing' => Project::where([[$role, $id], ['status_id', '3']])->count(),
            'success' => Project::where([[$role, $id], ['status_id', '>', '3'], ['status_id', '<', '100']])->count(),
        ]);
        $projects =  Project::where($role, $id)->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);
        $user = User::where('id', $id)->with('details', 'role', 'type')->first();
        $user->badge = $badge;
        return view('account.index', compact('user', 'projects'));
    }
    public function projects()
    {
        if (auth()->user()->role_id !== 1) {
            $role = 'partner_id';
        } else {
            $role = 'user_id';
        }
        $get = Project::where($role,  auth()->id())->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->get();
        $project = $get->groupBy('status_id');
        return view('myProject', compact('project'));
    }
    public function projects_status($status_id)
    {
        if (auth()->user()->role_id !== 1) {
            $role = 'partner_id';
        } else {
            $role = 'user_id';
        }
        return $project = Project::where([[$role, auth()->id()], ['status_id',  $status_id]])->with('subtype',  'user.details', 'status', 'partner')->orderBy('created_at', 'DESC')->paginate(5);

        return view('myProjectSorted', compact('project'));
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
        toast('Ubah Profil Berhasil', 'success');
        return redirect(route('account.profile', ['id' => auth()->id()]));
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
        toast('Ubah Password berhasil', 'success');
        return redirect(route('account.password'));
    }
}
