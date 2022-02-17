<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{

    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $data = DB::table('satuan')
            ->get();
        return view('/master/satuan',[
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
        return view('satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->collect();
        
         DB::table('satuan')->insert(array(
             'name' => $data['satuan'],
             )
        ); 
        return redirect()->route('satuan.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        //
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        //
        //$data = $request->collect(); //la teros iki
        
        /*DB::table('satuan')
            ->where('id', $data['id'])
            ->update(array(
                'name' => $data['satuan']
            ));

        return redirect()->route('satuan.index')->with('status','Success!!');*/            

        $data=$request->validate([
            'name'=> 'required'
         ]);
         $satuan->update($data);
         return redirect()->route('stories.index')->with('status','Success updated!!');//balek ke halaman awal
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        DB::table('satuan')->where('id', $id)->delete();
        return redirect()->route('satuan.index')->with('status','Success!!');
    }
}
