<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['karyawan'] = User::orderBy('id', 'DESC')->get();
        return view('pages.user', $data);
        // return $data;
    }

    public function tambah(Request $request)
    {
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $simpan = User::create($data);
        if ($simpan) {
            return redirect()->back();
        }
    }

    public function hapus($id)
    {
        $kategori = User::find($id);
        $kategori->delete();
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $simpan = User::where('id', $id)->update($data);
        if ($simpan) {
            return redirect()->back();
        }
    }
}
