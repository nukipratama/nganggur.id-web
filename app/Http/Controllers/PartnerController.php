<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return view('partner.verification.index');
    }

    public function question()
    {
        return view('partner.verification.question', [
            'questions' => auth()->user()->type->title === 'Pemrograman'
                ? __('question/programmer')
                : __('question/photography')
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'answer' => 'required|mimes:pdf|max:4000'
        ]);

        $answer = $request->file('answer');

        $file_mod_name = auth()->id() . '.' . $answer->getClientOriginalExtension();
        $file_path = 'upload/partner/verification/';
        $answer->move($file_path, $file_mod_name);

        $partner = Partner::where('user_id', auth()->id())->first();
        $partner->file = config('app.url') . '/' . $file_path . $file_mod_name;
        $partner->save();

        return redirect('home');
    }
}
