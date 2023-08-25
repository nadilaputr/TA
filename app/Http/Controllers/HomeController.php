<?php

namespace App\Http\Controllers;

use App\Helpers\TindakanSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $heads = [
            'No',
            'Nomor Surat',
            'Tanggal Diterima',
            'Asal Surat',
            'Perihal',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = [];
        if (Auth::user()->hasRole('admin')) {
            $suratMasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::TIDAK_TERUSKAN)->where('tindakan', '<>', TindakanSurat::SELESAI)
            ->get();
        }

        if (Auth::user()->hasRole('sekretaris')) {
            $suratMasuk = SuratMasuk::where('tindakan', TindakanSurat::TERUSKAN)->get();
        }

        if (Auth::user()->hasRole('kepaladinas')) {
            $suratMasuk = SuratMasuk::where('tindakan', TindakanSurat::TINDAK_LANJUT)->get();
        }

        return view('dashboard.home', [
            "heads" => $heads,
            "suratMasuk" => $suratMasuk
        ]);

    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json([
            'data' => $surat
        ]);
    }
}
