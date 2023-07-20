<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Brian2694\Toastr\Facades\Toastr;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategori'] = Kategori::with('parent')->orderBy('id', 'DESC')->get()->groupBy('parent_id');
        $data['parent'] = kategori::getParent()->orderBy('id', 'ASC')->get();

        return view('pages.kategori', $data);
        // return $data;
    }

    public function tambah(Request $request)
    {
        // $data = $request->only('nama','parent_id','deskripsi');
        // $data = $request->input(['slug' => $request->nama]);
        // $request->request->add(['slug' => $request->name]);

        $data = [
            'nama' => $request->nama,
            'parent_id' => $request->parent_id,
            'deskripsi' => $request->deskripsi,
            'slug' => $request->nama,
        ];

        $simpan = Kategori::create($data);
        if ($simpan) {
            return redirect()->back()->with([Toastr::success('Berhasil ditambahkan', 'Kategori ' . $request->nama)]);
        }
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'parent_id' => $request->parent_id,
            'deskripsi' => $request->deskripsi,
            'slug' => $request->nama,
        ];

        $simpan = Kategori::where('id', $id)->update($data);
        if ($simpan) {
            return redirect()->back()->with([Toastr::success('Berhasil diedit', 'Kategori ' . $request->nama)]);
        } else {
            return redirect()->back()->with([Toastr::error('Gagal diedit', 'Kategori ' . $request->nama)]);
        }
    }

    public function hapus($id)
    {
        $kategori = Kategori::withCount(['child'])->find($id);
        if ($kategori->child_count == 0) {
            $kategori->delete();
            return redirect()->back()->with([Toastr::success('Berhasil dihapus', 'Kategori ' . $kategori->nama)]);
        }
        return redirect()->back()->with([Toastr::error('kategori ini memiliki anak kategori, silahkan hapus anak kategori terlebih dahulu', 'Kategori ' . $kategori->nama . ' Gagal dihapus')]);
    }
}
