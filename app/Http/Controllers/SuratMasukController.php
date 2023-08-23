<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use TindakanSurat;

class SuratMasukController extends Controller
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

    public function index()
    {
        $heads = [
            'No',
            'Nomor Surat',
            'Tanggal Diterima',
            // 'Tanggal Surat',
            'Asal Surat',
            'Perihal',
            // 'Jenis Surat',
            // 'Catatan',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratmasuk = SuratMasuk::whereIn('tindakan', [0, 1, 5])->get();
        return view('suratmasuk.index', [
            "surat" => $suratmasuk,
            "heads" => $heads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('suratmasuk.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'jenis' => 'required',
            'sifat' => 'required',
            'file' => 'required|mimes:jpg,jpeg,pdf,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $file = $request->file('file');
        $fileName = 'suratmasuk-' . $file->getClientOriginalName();
        $path = $file->storeAs('suratmasuk', $fileName, 'public');

        $data['file'] = $path;

        try {
            SuratMasuk::create($data);
            return response()->json(['message' => 'Surat Masuk berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat Surat Masuk'], 500);
        }
    }

    public function updateTindakan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tindakan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        try {
            SuratMasuk::where('id', $id)->update($data);

            return response()->json(['message' => 'Surat Masuk berhasil diteruskan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan TindakanSurat'], 500);
        }
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json([
            'data' => $surat
        ]);
    }

    public function edit(int $id)
    {
        $surat = SuratMasuk::findOrFail($id);

        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => [
                'required',
                Rule::unique('surat_masuk')->ignore($id),
            ],
            'tanggal_surat' => 'required|date',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'sifat' => 'required',
            'jenis' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,pdf',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'files-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        try {
            SuratMasuk::where('id', $id)->update($data);

            return response()->json(['message' => 'Surat Masuk berhasil diubah'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengubah Surat'], 500);
        }
    }

    public function destroy($id)
    {
        SuratMasuk::where('id', $id)->delete();
        // return redirect()->route('suratmasuk.index')->with('success', 'Data berhasil dihapus');
    }
}
