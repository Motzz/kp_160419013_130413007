<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
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
        $dataGudang = DB::table('gudang')
            ->get();
        $dataLokasi = DB::table('lokasi')
            ->get();
        return view('/master/gudang',[
            'dataGudang' => $dataGudang,
            'dataLokasi' => $dataLokasi,
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
        return view('master.gudang_tambah');
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
        $data = $request->collect();
        
        DB::table('gudang')->insert(array(
             'name' => $data['name'],
             'alamat' => $data['alamat'],
             'keterangan' => $data['keterangan'],
             'idLokasi' => $data['lokasi'],
             )
        ); 
        return redirect()->route('gudang.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function show(Gudang $gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit(Gudang $gudang)
    {
        //
        $dataLokasi = DB::table('lokasi')
            ->get();
        return view('master.gudang_edit',[
            'gudang'=>$gudang,
            'dataLokasi' => $dataLokasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        //
        $data = $request->collect(); //la teros iki
        
        DB::table('gudang')
            ->where('id', $gudang['id'])
            ->update(array(
                'name' => $data['name'],
                'alamat' => $data['alamat'],
                'keterangan' => $data['keterangan'],
                'idLokasi' => $data['lokasi'],
            ));

        return redirect()->route('gudang.index')->with('status','Success!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gudang $gudang)
    {
        //
        $gudang->delete();
        return redirect()->route('gudang.index')->with('status','Success!!');
    }
}
