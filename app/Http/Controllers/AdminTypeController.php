<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class AdminTypeController extends Controller
{
    public function ubah(Type $type)
    {
        $type->load('subtypes');
        return $type;
    }
    public function hapus(Type $type)
    {
        $type->delete();
        return $type;
    }
}
