<?php

namespace App\Http\Controllers;

use App\Models\PT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $data = DB::table('pt')
            ->get();
        return view('master.pt',[
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
        return view('master.pt_tambah');
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
        
        DB::table('pt')->insert(array(
             'name' => $data['name'],
             'alias' => $data['alias'],
             )
        ); 
        return redirect()->route('pt.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PT  $pT
     * @return \Illuminate\Http\Response
     */
    public function show(PT $pT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PT  $pT
     * @return \Illuminate\Http\Response
     */
    public function edit(PT $pT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PT  $pT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PT $pT)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PT  $pT
     * @return \Illuminate\Http\Response
     */
    public function destroy(PT $pT)
    {
        //
    }
}