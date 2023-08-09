<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = [
            'Tanggal Disposisi',
            'Diteruskan Kepada',
            'Perihal',
            'Status',
            'Catatan',
            // 'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $disposisi = Disposisi::all();
        return view('disposisi.index', [
            "disposisi" => $disposisi,
            "heads" => $heads,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catatan' => 'required',
            'tindakan_dari' => 'required',
            'diteruskan_kepada' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        if ($request->tindakan == 'tindak-lanjut') {
            $data['status'] = $request->tindakan;
        } else {
            $data['status'] = 'dalam-proses';
        }

        try {

            SuratMasuk::where('id', $id)->update($data);

            return redirect()->route('disposisi.index')->with('success', 'Surat Masuk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('eror', 'Terjadi kesalahan saat menyimpan Tindakan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
