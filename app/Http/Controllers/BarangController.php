<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

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
        //
        $dataBarang = DB::table('barang')
            ->get();
        $dataSatuan = DB::table('satuan')
            ->get();
        return view('/master/barang',[
            'dataBarang' => $dataBarang,
            'dataSatuan' => $dataSatuan,
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
        return view('master.barang_tambah');
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
        /*$data = $request->collect();
        
        // insert data ke table pegawai
         DB::table('barang')->insert([
            'name' => $request->name,
            'code' => $request->code,
            'idSatuan' => $request->idSatuan
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect()->route('barang.index')->with('status','Success!!');*/

        $data = $request->collect();
        
        DB::table('barang')->insert(array(
             'name' => $data['name'],
             'code' => $data['code'],
             'idSatuan' => $data['Satuan'],
             )
        ); 
        return redirect()->route('barang.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
         $dataSatuan = DB::table('satuan')
            ->get();
        return view('master.barang_edit',[
            'barang'=>$barang,
            'dataSatuan' => $dataSatuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
        $data = $request->collect(); //la teros iki
        
        DB::table('barang')
            ->where('id', $barang['id'])
            ->update(array(
                'name' => $data['name'],
                'code' => $data['code'],
                'idSatuan' => $data['satuan'],
            ));

        return redirect()->route('barang.index')->with('status','Success!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
        $barang->delete();
        return redirect()->route('barang.index')->with('status','Success!!');
    }
}
