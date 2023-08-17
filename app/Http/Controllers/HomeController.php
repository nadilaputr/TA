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
            'Alamat surat',
            'Perihal',
            'Tanggal Diterima',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = [];

        if (Auth::user()->hasAnyRole(['admin', 'sekretaris'])) {
            $suratMasuk = SuratMasuk::where('tindakan', TindakanSurat::TERUSKAN)->get();
        } elseif (Auth::user()->hasRole('kepaladinas')) {
            $suratMasuk = SuratMasuk::where('tindakan', TindakanSurat::TINDAK_LANJUT)->get();
        }

        return view('home', [
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