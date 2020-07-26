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
        $programmerQuestion = [
            'Jelaskan apa yang anda ketahui tentang Object Oriented Programming!',
            'Jelaskan apa yang anda ketahui tentang bahasa pemrograman favorit anda!',
            'Menurut Anda, apa yang menjadi tanggung jawab seorang programmer?',
            'Jelaskan proyek apa yang telah sukses anda jalani!',
            'Apa motivasi terbesar anda untuk bergabung menjadi Mitra Nganggur.id?',
            'Jika telah diterima sebagai Mitra Nganggur.id, apakah anda bersedia untuk mengerjakan proyek yang diambil dengan baik?',
        ];
        $photographyQuestion = [
            'Apa yang dapat anda lakukan untuk menghindari hasil foto yang tampak kabur?',
            'Bagaimana anda mendapatkan foto indoor yang bagus?',
            'Pengaturan kamera seperti apa yang biasanya anda gunakan pada setiap kondisi?',
            'Jelaskan proyek apa yang telah sukses anda jalani!',
            'Apa motivasi terbesar anda untuk bergabung menjadi Mitra Nganggur.id?',
            'Jika telah diterima sebagai Mitra Nganggur.id, apakah anda bersedia untuk mengerjakan proyek yang diambil dengan baik?',
        ];
        $question = auth()->user()->type->title === 'Pemrograman' ? $programmerQuestion : $photographyQuestion;
        return view('partner.verification.question', compact('question'));
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
        $path = config('app.url') . '/' . $file_path . $file_mod_name;
        $partner = Partner::where('user_id', auth()->id())->first();
        $partner->file = $path;
        $partner->save();
        return redirect('home');
    }
}
