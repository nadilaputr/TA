<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'Tanggal Surat',
            'Asal Surat',
            'Tanggal Masuk',
            'Perihal',
            'Jenis Surat',
            'Catatan',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratmasuk = SuratMasuk::whereIn('tindakan', [0, 1])->get();
        return view('suratmasuk.index', [
            "surat" => $suratmasuk,
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
        return view('suratmasuk.create');
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $file = $request->file('file');
        $fileName = 'suratmasuk-' .  $file->getClientOriginalName();
        $path = $file->storeAs('suratmasuk', $fileName, 'public');


        $data['file'] = $path;

        SuratMasuk::create($data);

        return redirect()->route('masuk.index')->with('success', 'Surat Masuk berhasil ditambahkan');
    }

    public function updateTindakan(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'tindakan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        try {
            SuratMasuk::where('id', $id)->update($data);

            return redirect()->route('suratmasuk.index')->with('success', 'Surat Berhasil Diteruskan');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan TindakanSurat.');
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
        $surat = SuratMasuk::findOrFail($id);
        return response()->json([
            'data' => $surat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $config = ['format' => 'L'];
        $surat = SuratMasuk::findOrFail($id);

        return view('suratmasuk.edit', [
            "surat" => $surat,
            "config" => $config
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']); // Exclude unnecessary fields from the update data

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'files-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        SuratMasuk::where('id', $id)->update($data);

        return redirect()->route('masuk.index')->with('success', 'Surat Masuk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        SuratMasuk::where('id', $id)->delete();
        return redirect()->route('masuk.index')->with('success', 'Data berhasil dihapus');
    }
}
