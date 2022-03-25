<?php

namespace App\Http\Controllers;

use App\Models\MPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MPerusahaanController extends Controller
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
        $data = DB::table('MPerusahaan')
            ->get();
        return view('master.mPerusahaan.index',[
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
        $users = DB::table('users')
            ->get();    
        return view('master.mPerusahaan.tambah',[
            'users' => $users,
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
        
        DB::table('MPerusahaan')
            ->insert(array(
                'cname' => $data['name'],
                'cnames' => $data['names'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
                'UserIDManager' => $data['manager']
            )
        );
        return redirect()->route('mPerusahaan.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MPerusahaan  $mPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(MPerusahaan $mPerusahaan)
    {
        $data = DB::table('MPerusahaan')
            ->join('users','MPerusahaan.UserIDManager','=','users.id')
            ->get();
        return view('master.mPerusahaan.detail',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPerusahaan  $mPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(MPerusahaan $mPerusahaan)
    {
        //
        $users = DB::table('users')
            ->get();    
        return view('master.mPerusahaan.edit',[
            'mPerusahaan' => $mPerusahaan,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPerusahaan  $mPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPerusahaan $mPerusahaan)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('MPerusahaan')
            ->where('MPerusahaanID', $mPerusahaan['MPerusahaanID'])
            ->update(array(
                'cname' => $data['name'],
                'cnames' => $data['names'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
                'UserIDManager' => $data['manager']
            )
        );
        return redirect()->route('mPerusahaan.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MPerusahaan  $mPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPerusahaan $mPerusahaan)
    {
        //
        $mPerusahaan->delete();
        return redirect()->route('mPerusahaan.index')->with('status','Success!!');
    }

    public function searchPerusahaanName($perName)
    {
        //
        $data = DB::table('MPerusahaan')
            ->where('cname','like','%'.$perName.'%')
            ->get();
        return view('master.mPerusahaan',[
            'data' => $data,
        ]);
    }
}
