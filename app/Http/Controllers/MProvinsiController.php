<?php

namespace App\Http\Controllers;

use App\Models\MProvinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MProvinsiController extends Controller
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
        $data = DB::table('MProvinsi')
            ->get();
        return view('master.mProvinsi',[
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
        return view('master.mProvinsi_tambah');
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
        
        DB::table('MProvinsi')
            ->insert(array(
                'cidprov' => $data['cid'],
                'cname' => $data['name'],
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
     * @param  \App\Models\MProvinsi  $mProvinsi
     * @return \Illuminate\Http\Response
     */
    public function show(MProvinsi $mProvinsi)
    {
        //
        $data = DB::table('MProvinsi')
            ->get();
        return view('master.mProvinsi_detail',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MProvinsi  $mProvinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(MProvinsi $mProvinsi)
    {
        //
        return view('master.mProvinsi_edit',[
            'mProvinsi' => $mProvinsi,
        ]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MProvinsi  $mProvinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MProvinsi $mProvinsi)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MProvinsi')
            ->where('MProvinsiID', $mProvinsi['id'])
            ->update(array(
                'cidprov' => $data['cid'],
                'cname' => $data['name'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MProvinsi  $mProvinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MProvinsi $mProvinsi)
    {
        //
        $mProvinsi->destroy();
    }
}
