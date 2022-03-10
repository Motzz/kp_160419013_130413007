<?php

namespace App\Http\Controllers;

use App\Models\MKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MKotaController extends Controller
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
        $data = DB::table('MKota')
            ->select('MKota.*', 'MProvinsi.cname as provinsiName', 'MPulau.cname as pulauName')
            ->leftjoin('MPulau','MKota.cidpulau','=','MPulau.cidpulau')
            ->leftjoin('MProvinsi','MKota.cidprov','=','MProvinsi.cidprov')
            ->get();
        return view('master.mKota',[
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
        $dataMPulau = DB::table('MPulau')
            ->get();
        $dataMProvinsi = DB::table('MProvinsi')
            ->get();    
        return view('master.mKota_tambah',[
            'dataMPulau' => $dataMPulau,
            'dataMProvinsi' => $dataMProvinsi,
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
        
        DB::table('MKota')
            ->insert(array(
                'cidkota' => $data['cid'],
                'ckode' => $data['kode'],
                'cname' => $data['name'],
                'cidprov' => $data['prov'],
                'cidpulau' => $data['pulau'],
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
     * @param  \App\Models\MKota  $mKota
     * @return \Illuminate\Http\Response
     */
    public function show(MKota $mKota)
    {
        //
        /*$data = DB::table('MKota')
            ->select('MKota.*', 'MProvinsi.cname as provinsiName', 'MPulau.cname as pulauName')
            ->leftjoin('MPulau','MKota.cidpulau','=','MPulau.cidpulau')
            ->leftjoin('MProvinsi','MKota.cidprov','=','MProvinsi.cidprov')
            ->get();*/
        return view('master.mKota_detail',[
            'mKota' => $mKota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MKota  $mKota
     * @return \Illuminate\Http\Response
     */
    public function edit(MKota $mKota)
    {
        //
        $dataMPulau = DB::table('MPulau')
            ->get();
        $dataMProvinsi = DB::table('MProvinsi')
            ->get();    
        return view('master.mKota_edit',[
            'mKota' => $mKota,
            'dataMPulau' => $dataMPulau,
            'dataMProvinsi' => $dataMProvinsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MKota  $mKota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MKota $mKota)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MKota')
            ->where('MKotaID', $mKota['id'])
            ->update(array(
                'cidkota' => $data['cid'],
                'ckode' => $data['kode'],
                'cname' => $data['name'],
                'cidprov' => $data['prov'],
                'cidpulau' => $data['pulau'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MKota  $mKota
     * @return \Illuminate\Http\Response
     */
    public function destroy(MKota $mKota)
    {
        //
        $mKota->destroy();
    }

    public function searchKotaName($kotaName)
    {
        //
        $data = DB::table('MKota')
            ->select('MKota.*', 'MProvinsi.cname as provinsiName', 'MPulau.cname as pulauName')
            ->leftjoin('MPulau','MKota.cidpulau','=','MPulau.cidpulau')
            ->leftjoin('MProvinsi','MKota.cidprov','=','MProvinsi.cidprov')
            ->where('MKota.cname','like','%'.$kotaName.'%')
            ->get();
        return view('master.mKota',[
            'data' => $data,
        ]);
    }
}
