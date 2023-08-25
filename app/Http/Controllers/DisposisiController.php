<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $disposisi = Disposisi::with(['surat_masuk', 'bidang'])->get();
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

        return view('disposisi.print', [
            "disposisi" => $disposisi
        ]);
    }
}
