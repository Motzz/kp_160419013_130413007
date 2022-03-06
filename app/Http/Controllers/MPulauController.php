<?php

namespace App\Http\Controllers;

use App\Models\MPulau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MPulauController extends Controller
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
        $data = DB::table('MPulau')
            ->get();
        return view('master.mPulau',[
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
        return view('master.mPulau_tambah');
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
        
        DB::table('MPulau')
            ->insert(array(
                'cidpulau' => $data['cid'],
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
     * @param  \App\Models\MPulau  $mPulau
     * @return \Illuminate\Http\Response
     */
    public function show(MPulau $mPulau)
    {
        //
        $data = DB::table('MPulau')
            ->get();
        return view('master.mPulau_detail',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPulau  $mPulau
     * @return \Illuminate\Http\Response
     */
    public function edit(MPulau $mPulau)
    {
        //
        return view('master.mPulau_edit',[
            'mPulau' => $mPulau,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPulau  $mPulau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPulau $mPulau)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MPulau')
            ->where('MPulauID', $mPulau['id'])
            ->update(array(
                'cidpulau' => $data['cid'],
                'cname' => $data['name'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MPulau  $mPulau
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPulau $mPulau)
    {
        //
        $mPulau->destroy();
    }
}
