<?php

namespace App\Http\Controllers;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

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
            'Tanggal Surat',
            'Asal Surat',
            'Perihal',
            'Status',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5]
        ];

        $suratMasuk = SuratMasuk::where('tindakan', 1)->get();

        return view('home', [
            "heads" => $heads,
            "suratMasuk" => $suratMasuk 
        ]);
    }
}
