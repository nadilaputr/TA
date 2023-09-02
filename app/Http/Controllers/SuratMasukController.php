<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\TindakanSurat;
// use TindakanSurat;
use Illuminate\Support\Facades\Auth;

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
            'Tanggal Input',
            // 'Tanggal Surat',
            'Asal Surat',
            'Perihal',
            // 'Jenis Surat',
            // 'Catatan',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
            
        ];

        $suratmasuk = [];

        if (Auth::user()->hasRole('admin')) {
            $suratmasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA)
            ->where('tindakan', '<>', TindakanSurat::DISPOSISI)
            ->where('tindakan', '<>', TindakanSurat::TINDAK_LANJUT)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        if (Auth::user()->hasRole('sekretaris')) {
            $suratmasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::TINDAK_LANJUT)
            ->where('tindakan', '<>', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        if (Auth::user()->hasRole('kepaladinas')) {
            $suratmasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::DITERIMA)
            ->where('tindakan', '<>', TindakanSurat::REVISI)
            ->where('tindakan', '<>', TindakanSurat::TELAH_DIREVISI)
            ->where('tindakan', '<>', TindakanSurat::DISPOSISI)
            ->where('tindakan', '<>', TindakanSurat::TINDAK_LANJUT)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        // $suratmasuk = SuratMasuk::whereIn('tindakan', [0, 1, 5])->orderBy('created_at', 'desc')->get();

        return view('suratmasuk.index', [
            "surat" => $suratmasuk,
            "heads" => $heads,
        ]);
    }

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
            'tingkat_keamanan' => 'required',
            'file' => 'required|mimes:jpg,jpeg,pdf,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $file = $request->file('file');
        $fileName = 'suratmasuk-' . $file->getClientOriginalName();
        $filePath = public_path('surat-masuk'); // Path to the public folder
        $file->move($filePath, $fileName); // Move the file to the public folder

        $data['file'] = 'surat-masuk/' . $fileName; // Save relative path

        try {
            SuratMasuk::create($data);
            return response()->json(['message' => 'Surat Masuk berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat Surat Masuk', $e], 500);
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
        $surat = SuratMasuk::with('disposisi')->where('id', $id)->first();
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
            'tingkat_keamanan' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,pdf',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'updateSuratMasuk-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('updateSuratMasuk', $fileName, 'public');
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

        $suratMasuk = SuratMasuk::find($id);

        if ($suratMasuk->disposisi) {
            $suratMasuk->disposisi->delete();
        }

        $suratMasuk->delete();
    }
}