<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangTambahController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataSatuan = DB::table('satuan')
            ->get();
        return view('/master/barang_tambah',[
            'dataSatuan' => $dataSatuan,
        ]);
    }
}
