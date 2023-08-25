<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\TindakanSurat;
use Spatie\Browsershot\Browsershot;
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
            'No',
            'No Surat',
            'Asal Surat',
            'Perihal',
            'Catatan',
            'Tindakan',
            'Bidang',
            // 'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        if (auth()->user()->hasAnyRole(['kepaladinas', 'admin'])) {
            $disposisi = Disposisi::with(['surat_masuk', 'bidang'])
                ->whereHas('surat_masuk', function ($query) {
                    $query->where('tindakan', TindakanSurat::SELESAI);
                })->get();
        } else {
            $disposisi = Disposisi::with(['surat_masuk', 'bidang'])
                ->whereHas('bidang', function ($query) {
                    $bidang = auth()->user()->id_bidang;
                    $query->where('id', $bidang);
                })
                ->get();
        }

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catatan' => 'required',
            'id_bidang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $data["id_user"] = auth()->user()->id;

        try {
            Disposisi::create($data);

            return response()->json(['message' => 'Disposisi berhasil dibuat'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan disposisi.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($id)
    {

        $disposisi = Disposisi::with(['surat_masuk', 'bidang'])
            ->whereHas('surat_masuk', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->first();

        // Memeriksa apakah tindakan surat sudah selesai (SELESAI)
        if ($disposisi->surat_masuk->tindakan == TindakanSurat::SELESAI) {
            // Jika tindakan sudah selesai, tambahkan data paraf
            $paraf = 'Sudah diparaf'; // Gantilah dengan data paraf yang sesuai
        } else {
            $paraf = ''; // Jika tindakan belum selesai, biarkan kosong
        }

        return view('disposisi.print', [
            "disposisi" => $disposisi,
            "paraf" => $paraf, 
        ]);
    }

    public function selesaiDisposisi($id)
{
    // Cari disposisi berdasarkan $id
    $disposisi = Disposisi::find($id);

    if (!$disposisi) {
        return abort(404); // Tindakan jika disposisi tidak ditemukan
    }

    // Tandai disposisi sebagai selesai
    $disposisi->status = TindakanSurat::SELESAI;

    // Atur tanggal penyelesaian ke waktu saat ini
    $disposisi->tanggal_penyelesaian = Carbon::now();

    // Simpan perubahan
    $disposisi->save();

    // Lanjutkan dengan tindakan lain yang sesuai
    // ...

    return redirect()->back()->with('success', 'Disposisi telah ditandai sebagai selesai.');
}
}
