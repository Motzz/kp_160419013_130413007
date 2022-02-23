<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LokasiController extends Controller
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
        $dataLokasi = DB::table('lokasi')
            ->get();
        $dataPt = DB::table('pt')
            ->get();
        return view('master.lokasi',[
            'dataLokasi' => $dataLokasi,
            'dataPt' => $dataPt,
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
        $dataLokasi = DB::table('lokasi')
            ->get();
        $dataPt = DB::table('pt')
            ->get();
         return view('master.lokasi_tambah',[
            'dataLokasi'=>$dataLokasi,
            'dataPt' => $dataPt,
        ]);
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
        
        DB::table('lokasi')->insert(array(
             'name' => $data['name'],
             'alias' => $data['alias'],
             'keterangan' => $data['keterangan'],
             'idPt' => $data['pt'],
             )
        ); 
        return redirect()->route('lokasi.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        //
        $dataPt = DB::table('pt')
            ->get();
        return view('master.lokasi_edit',[
            'lokasi'=>$lokasi,
            'dataPt' => $dataPt,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //
        $data = $request->collect(); //la teros iki
        
        DB::table('lokasi')
            ->where('id', $lokasi['id'])
            ->update(array(
                'name' => $data['name'],
                'alias' => $data['alias'],
                'keterangan' => $data['keterangan'],
                'idPt' => $data['pt'],
            ));

        return redirect()->route('lokasi.index')->with('status','Success!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasi)
    {
        //
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('status','Success!!');
    }
}
