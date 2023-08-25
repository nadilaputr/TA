<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataOperatorController extends Controller
{
    public function index()
    {
        $heads = [
            'No',
            'Nama',
            'Username',
            'Jabatan',
            'Bidang',
            'Role',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $dataOperator = User::all();

        return view('dataoperator.index', [
            "dataOperator" => $dataOperator,
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
        //
    }


    public function show($id)
    {
        $dataOperator = User::findOrFail($id);
        return response()->json([
            'data' => $dataOperator
        ]);
    }

    public function edit($id)
    {
        $dataOperator = User::findOrFail($id);
        $bidang = Bidang::all();

        return view('dataoperator.edit', [
            "edit" => $dataOperator,
            "bidang" => $bidang,
        ]);
    }

    public function editPassword($id)
    {
        $dataOperator = User::findOrFail($id);

        return view('dataoperator.edit_password', [
            "operator" => $dataOperator,
        ]);
    }

    public function editRole($id)
    {
        $dataOperator = User::findOrFail($id);
        $roles = Role::all()->pluck('name');

        $operatorRole = $dataOperator->getRoleNames()->first();

        return view('dataoperator.edit_role', [
            "operator" => $dataOperator,
            "operatorRole" => $operatorRole,
            "roles" => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'jabatan' => 'required',
            'id_bidang' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        User::where('id', $id)->update($data);

        return redirect()->route('dataoperator.index')->with('success', 'Data Operator berhasil diubah');

    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
            ],
            [
                'password.required' => 'Silakan masukkan kata sandi.',
                'password.min' => 'Kata sandi harus minimal :min karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
                'password_confirmation.required' => 'Silakan konfirmasi kata sandi.',
                'password_confirmation.min' => 'Konfirmasi kata sandi harus minimal :min karakter.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        User::where('id', $id)->update([
            "password" => Hash::make($request->password)
        ]);

        return redirect()->route('dataoperator.index')->with('success', 'Password berhasil diubah');
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role' => 'required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataOperator = User::findOrFail($id);
        $dataOperator->syncRoles([$request->input('role')]);
        $dataOperator->save();

        return redirect()->route('dataoperator.index')->with('success', 'Role berhasil diubah');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
    }
}