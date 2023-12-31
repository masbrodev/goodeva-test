<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Models\Kategori;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['ontime'] = Absen::where('kategori', 'ontime')->count();
        $data['telat'] = Absen::where('kategori', 'telat')->count();

        // $data['ont'] = Absen::where('kategori', 'telat')->groupBy('jam')->get();

        // $day = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];

        // $data['otm'] = [];
        // $data['tlt'] = [];
        // foreach ($day as $key => $value) {
        //     // $data['dtm'][] = Absen::where(Absen::raw("DATE_FORMAT('jam', '%m')"), $value)->count();
        //     // $data['dtk'][] = SuratKeluar::where(SuratKeluar::raw("DATE_FORMAT(tanggal_keluar, '%m')"),$value)->count();
        // }


        $result = DB::table('absens')
            ->select(DB::raw('DATE(waktu) AS tanggal'))
            ->selectRaw('SUM(CASE WHEN kategori = "telat" THEN 1 ELSE 0 END) AS total_telat')
            ->selectRaw('SUM(CASE WHEN kategori = "ontime" THEN 1 ELSE 0 END) AS total_ontime')
            ->groupBy(DB::raw('DATE(waktu)'))
            ->get();

        $data['labels'] = $result->pluck('tanggal')->toArray();

        // Array untuk data total telat
        $data['dataTelat'] = $result->pluck('total_telat')->toArray();

        // Array untuk data total ontime
        $data['dataOntime'] = $result->pluck('total_ontime')->toArray();
        return view('home', $data);
        // return $data;
    }
}
