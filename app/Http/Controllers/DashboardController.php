<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use App\Models\PencatatanHafalan;
use App\Models\Santri;
use App\Models\Ustadzah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $ziyadah = JadwalHafalan::where('jenis_hafalan', 'ziyadah')->get();
        $murajaah = JadwalHafalan::where('jenis_hafalan', "murajaah")->get();
        $santri = Santri::all()->count();
        $ustad = Ustadzah::all()->count();
        $pencatatan_hafalan = PencatatanHafalan::all()->count();
        $santri_lulus = Santri::all()->where('status', 'Lulus')->count();
        // dd($murajaah);
        return view('pages.dashboard' , compact('ziyadah', 'murajaah', 'santri', 'ustad', 'pencatatan_hafalan', 'santri_lulus'));
    }
}
