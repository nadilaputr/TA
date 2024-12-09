<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
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
            'Nomor Surat',
            'Dari Bidang',
            'Sifat',
            'Alamat Tujuan',
            'Perihal',
            'Tanggal Surat',
            'Lampiran',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $bidang = Bidang::all();
        $suratkeluar = SuratKeluar::all();
        return view('suratkeluar.index', [
            "bidang" => $bidang,
            "suratkeluar" => $suratkeluar,
            "heads" => $heads,
        ]);
    }

    public function create()
    {
        return view('suratkeluar.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|unique:surat_keluar',
            'tanggal_surat' => 'required|date',
            'alamat_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'sifat' => 'required',
            'id_bidang' => 'required',
            'file' => 'required|mimes:jpg,jpeg,pdf,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $file = $request->file('file');
        $fileName = 'suratkeluar-' . $file->getClientOriginalName();
        $filePath = public_path('surat-keluar'); // Path to the public folder
        $file->move($filePath, $fileName); // Move the file to the public folder

        $data['file'] = 'surat-keluar/' . $fileName; // Save relative path

        try {
            SuratKeluar::create($data);
            return response()->json(['message' => 'Surat Keluar berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }


    public function show($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        return response()->json([
            'data' => $suratKeluar
        ]);
    }


    public function edit($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        return response()->json([
            'suratkeluar' => $suratKeluar,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => [
                'required',
                Rule::unique('surat_keluar')->ignore($id),
            ],
            'tanggal_surat' => 'required|date',
            'alamat_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'sifat' => 'required',
            'id_bidang' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,pdf,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'updateSuratKeluar-' . time() . '.' . $file->getClientOriginalExtension();
            $filepath = public_path('updateSuratKeluar');
            $file->move($filepath, $fileName);

            $data['file'] = 'updateSuratKeluar/' . $fileName;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        try {
            SuratKeluar::where('id', $id)->update($data);

            return response()->json(['message' => 'Surat Keluar berhasil diubah'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengubah Surat'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuratKeluar::where('id', $id)->delete();
    }
}