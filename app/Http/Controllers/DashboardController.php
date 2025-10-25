<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $ziyadah = JadwalHafalan::where('jenis_hafalan', 'ziyadah')->get();
        $murajaah = JadwalHafalan::where('jenis_hafalan', "murajaah")->get();
        // dd($murajaah);
        return view('pages.dashboard' , compact('ziyadah', 'murajaah'));
    }
}
