<?php

namespace App\Http\Controllers;

use App\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $data['absen'] = Absen::with('user')->orderBy('id', 'DESC')->get();
        return view('pages.absen', $data);
        // return $data;
    }
}
