<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\TindakanSurat;
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
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = [];

        if (Auth::user()->hasRole('admin')) {
            $suratMasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::DITERIMA)
                ->where('tindakan', '<>', TindakanSurat::ARSIP)
                ->orderBy('created_at', 'desc')
                ->get();

        } else if (Auth::user()->hasRole('sekretaris')) {
            $suratMasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::DITERIMA)
            ->where('tindakan', '<>', TindakanSurat::ARSIP)
            ->orderBy('created_at', 'desc')
            ->get();

        } else if (Auth::user()->hasRole('kepaladinas')) {
            $suratMasuk = SuratMasuk::where('tindakan', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $suratMasuk = SuratMasuk::whereHas("disposisi", function ($query) {
                $query->where('id_bidang', auth()->user()->id_bidang);
            })->where('tindakan', TindakanSurat::TINDAK_LANJUT)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $jumlahDisposisi = Disposisi::all();
        $jumlahSuratMasuk = SuratMasuk::all();
        $jumlahSuratKeluar = SuratKeluar::all();
        $jumlahUser = User::all();

        return view('dashboard.home', [
            "heads" => $heads,
            "suratMasuk" => $suratMasuk,
            "jumlahDisposisi" => count($jumlahDisposisi),
            "jumlahSuratMasuk" => count($jumlahSuratMasuk),
            "jumlahSuratKeluar" => count($jumlahSuratKeluar),
            "jumlahUser" => count($jumlahUser)
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