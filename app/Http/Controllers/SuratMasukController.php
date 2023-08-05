<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'Status',
            'Catatan',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratmasuk = SuratMasuk::where('tindakan', 0)->get();
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
            'status' => 'required',
            'sifat' => 'required',
            'file' => 'required|mimes:jpg,jpeg,pdf',
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

        try {

            SuratMasuk::where('id', $id)->update([
                "tindakan" => $request->tindakan,
                "catatan" => $request->catatan,
            ]);


            return redirect()->route('masuk.index')->with('success', 'Surat Masuk berhasil ditambahkan');
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
            'status' => 'required',
            'tindakan' => 'required',
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
