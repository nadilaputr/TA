<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\TindakanSurat;
use App\Models\Disposisi;
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
            'Asal Surat',
            'Perihal',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],

        ];

        $suratmasuk = [];

        if (Auth::user()->hasRole('admin')) {
            $suratmasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA)
                ->where('tindakan', '<>', TindakanSurat::DISPOSISI)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if (Auth::user()->hasRole('sekretaris')) {
            $suratmasuk = SuratMasuk::where('tindakan', '<>', TindakanSurat::DISPOSISI)
                ->where('tindakan', '<>', TindakanSurat::MENUNGGU_INSTRUKSI_KEPALA)
                ->orderBy('created_at', 'desc')
                ->get();
        }

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
            // 'jenis' => 'nullable',
            // 'sifat' => 'nullable',
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
            'catatan' => 'nullable',
            'sifat' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        try {

            if ($data['tindakan'] == 2) {
                Disposisi::create([
                    'id_bidang' => $request->id_bidang,
                    'id_surat' => $request->id_surat,
                    'id_user' => Auth::user()->id,
                    'sifat' => $request->sifat,
                ]);

                SuratMasuk::where('id', $id)->update([
                    'tindakan' => $data['tindakan'],
                ]);
            } else if ($data['tindakan'] == 5) {
                SuratMasuk::where('id', $id)->update([
                    'tindakan' => $data['tindakan'],
                ]);
            } else if ($data['tindakan'] == 1) {
                SuratMasuk::where('id', $id)->update([
                    'catatan' => $data['catatan'],
                    'tindakan' => $data['tindakan'],
                ]);
            } else {
                SuratMasuk::where('id', $id)->update([
                    'tindakan' => $data['tindakan'],
                ]);

                Disposisi::where('id_surat', $id)->update([
                    'catatan' => $data['catatan'],
                ]);
            }


            return response()->json(['message' => 'Surat Masuk berhasil diteruskan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 402);
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
            'sifat' => 'nullable',
            'jenis' => 'nullable',
            'file' => 'nullable|mimes:jpg,jpeg,pdf',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'updateSuratMasuk-' . time() . '.' . $file->getClientOriginalExtension();
            $filepath = public_path('updateSuratMasuk');
            $file->move($filepath, $fileName);

            $data['file'] = 'updateSuratMasuk/' . $fileName;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        try {
            $suratMasuk = SuratMasuk::find($id);

            if ($suratMasuk->tindakan == 1) {
                $data['tindakan'] = 6;
            }

            $suratMasuk->update($data);


            return response()->json(['message' => 'Surat Masuk berhasil diubah'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
