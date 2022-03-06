<?php

namespace App\Http\Controllers;

use App\Models\MGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MGudangController extends Controller
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
        $data = DB::table('MGudang')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.MPerusahaanID')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->get();
        return view('master.mGudang',[
            'data' => $data,
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
        $dataMKota = DB::table('MKota')
            ->get();
        $dataMPerusahaan = DB::table('MPerusahaan')
            ->get();    
        return view('master.mGudang_tambah',[
            'dataMKota' => $dataMKota,
            'dataMPerusahaan' => $dataMPerusahaan,
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
        $user = Auth::user();
        
        DB::table('MGudang')
            ->insert(array(
                'ccode' => $data['code'],
                'cname' => $data['name'],   
                'cidp' => $data['perusahaan'],
                'cidkota' => $data['kota'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        ); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MGudang  $mGudang
     * @return \Illuminate\Http\Response
     */
    public function show(MGudang $mGudang)
    {
        //
        $data = DB::table('MGudang')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.MPerusahaanID')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->get();
        return view('master.mGudang_detail',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MGudang  $mGudang
     * @return \Illuminate\Http\Response
     */
    public function edit(MGudang $mGudang)
    {
        //
        $dataMKota = DB::table('MKota')
            ->get();
        $dataMPerusahaan = DB::table('MPerusahaan')
            ->get();    
        return view('master.mGudang_edit',[
            'mGudang' =>$mGudang,
            'dataMKota' => $dataMKota,
            'dataMPerusahaan' => $dataMPerusahaan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MGudang  $mGudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MGudang $mGudang)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MGudang')
            ->where('MGudangID', $mGudang['id'])
            ->update(array(
                'ccode' => $data['code'],
                'cname' => $data['name'],   
                'cidp' => $data['perusahaan'],
                'cidkota' => $data['kota'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MGudang  $mGudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(MGudang $mGudang)
    {
        //
        $mGudang->destroy();
    }
}
