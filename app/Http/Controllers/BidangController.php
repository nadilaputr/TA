<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = ['No', 'Nama Bidang', ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-alogn' => 'center']];

        $bidang = Bidang::all();
        return view('bidang.index', [
            "bidang" => $bidang,
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
        return view("bidang.create");
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
            'namabidang' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        try {

            Bidang::create($data);

            return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan bidang.');
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
        $bidang = Bidang::findOrFail($id);

        return view('bidang.edit', [
            "bidang" => $bidang,
        ]);
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
        $validator = Validator::make($request->all(), [
            'namabidang' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        Bidang::where('id', $id)->update($data);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bidang::where('id', $id)->delete();
        return redirect()->route('bidang.index')->with('success', 'Data berhasil dihapus');
    }
}
