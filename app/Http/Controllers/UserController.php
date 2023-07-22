<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Jika data dimulai dari baris ke-3 (indeks array 2), maka kita mulai membaca dari baris ke-3
            // dan lewati 2 baris pertama (baris ke-1 dan ke-2)
            for ($i = 2; $i < count($rows); $i++) {
                $row = $rows[$i];
                // Pastikan kolom sesuai dengan indeks array, atau gunakan associative array jika baris pertama adalah header
                // $id = $row[0];
                $name = $row[1];
                $email = $row[2];

                // Simpan data ke database
                User::create([
                    // 'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make(11111111)
                ]);
            }

            return redirect()->back()->with([Toastr::success('Data Berhasil Disimpan')]);
        } catch (\Exception $e) {
            return redirect()->back()->with([Toastr::error('Data Gagal Disimpan')]);
        }
    }
    public function dell()
    {
        User::truncateUsersTable();
        return redirect()->back()->with('success', 'Semua data pengguna berhasil dihapus.');
    }
}
