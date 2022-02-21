<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $data = DB::table('supplier')
            ->get();
        return view('/master/supplier',[
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
        return view('master.supplier_tambah');
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
        
        DB::table('supplier')->insert(array(
             'name' => $data['name'],
             'alamat' => $data['alamat'],
             'email' => $data['email'],
             'bank' => $data['bank'],
             'nomor_rekening' => $data['nomor_rekening'],
             'nomor_telepon' => $data['nomor_telepon'],
             )
        ); 
        return redirect()->route('supplier.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
        return view('master.supplier_edit',[
            'supplier'=>$supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
        $data = $request->collect(); //la teros iki
        
        DB::table('supplier')
            ->where('id', $supplier['id'])
            ->update(array(
                'name' => $data['name'],
                'alamat' => $data['alamat'],
                'email' => $data['email'],
                'bank' => $data['bank'],
                'nomor_rekening' => $data['nomor_rekening'],
                'nomor_telepon' => $data['nomor_telepon'],
            ));

        return redirect()->route('supplier.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
        return redirect()->route('supplier.index')->with('status','Success!!');
    }
}
