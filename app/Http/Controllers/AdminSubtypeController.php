<?php

namespace App\Http\Controllers;

use App\SubTypes;
use Illuminate\Http\Request;

class AdminSubtypeController extends Controller
{
    public function add()
    {
        return view('admin.form.subtype');
    }
    public function ubah(SubTypes $subtype)
    {
        return view('admin.form.subtype', compact('subtype'));
    }
    public function hapus(SubTypes $subtype)
    {
        $subtype->delete();
        return redirect()->back();
    }
    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'type' => 'required|exists:App\Type,id',
        ]);
        $data['title'] = $request->title;
        $data['subtitle'] = $request->subtitle;
        $data['type_id'] = $request->type;
        if ($request->icon) {
            $photo = $request->file('icon');
            $file_mod_name = $request->title . '.' . $photo->getClientOriginalExtension();
            $file_path = 'img/icon/subtype/';
            $photo->move($file_path, $file_mod_name);
            $path = $file_path . $file_mod_name;
            $data['icon'] = config('app.url') . '/' . $path;
        }
        SubTypes::updateOrCreate(['id' => $request->input('id')], $data);
        return redirect(route('admin.type'));
    }
}
