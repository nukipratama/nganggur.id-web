<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class AdminTypeController extends Controller
{
    public function add()
    {
        return view('admin.form.type');
    }
    public function ubah(Type $type)
    {
        return view('admin.form.type', compact('type'));
    }
    public function hapus(Type $type)
    {
        $type->delete();
        return redirect()->back();
    }
    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'color' => 'required',
        ]);
        $data['title'] = $request->title;
        $data['subtitle'] = $request->subtitle;
        $data['color'] = $request->color;
        if ($request->icon) {
            $photo = $request->file('icon');
            $file_mod_name = $request->title . '.' . $photo->getClientOriginalExtension();
            $file_path = 'img/icon/type/';
            $photo->move($file_path, $file_mod_name);
            $path = $file_path . $file_mod_name;
            $data['icon'] = config('app.url') . '/' . $path;
        }
        Type::updateOrCreate(['id' => $request->input('id')], $data);
        return redirect(route('admin.type'));
    }
}
