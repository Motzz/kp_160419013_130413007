<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = DB::table('suppliers')
            ->get();
        $dataBank = DB::table('bank')
            ->get();
        $dataInfoSupplier = DB::table('infoSupplier')
            ->get();
        return view('master.supplier',[
            'data' => $data,
            'dataBank' => $dataBank,
            'dataInfoSupplier' => $dataInfoSupplier,
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
        $data = DB::table('suppliers')
            ->get();
        $dataBank = DB::table('bank')
            ->get();
        $dataInfoSupplier = DB::table('infoSupplier')
            ->get();
        return view('master.supplier_tambah',[
            'data' => $data,
            'dataBank' => $dataBank,
            'dataInfoSupplier' => $dataInfoSupplier,
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
        
        DB::table('suppliers')->insert(array(
             'name' => $data['name'],
             'alamat' => $data['alamat'],
             'email' => $data['email'],
             'idBank'=>$data['idBank'],
             'nomor_rekening' => $data['nomor_rekening'],
             'nomor_telepon' => $data['nomor_telepon'],
             'idInfoSupplier'=>$data['idInfoSupplier']
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
        $dataBank = DB::table('bank')
            ->get();
        $dataInfoSupplier = DB::table('infoSupplier')
            ->get();
        return view('master.supplier_edit',[
            'supplier'=>$supplier,
            'dataBank' => $dataBank,
            'dataInfoSupplier' => $dataInfoSupplier
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
        
        DB::table('suppliers')
            ->where('id', $supplier['id'])
            ->update(array(
                'name' => $data['name'],
                'alamat' => $data['alamat'],
                'email' => $data['email'],
                'idBank'=>$data['idBank'],
                'nomor_rekening' => $data['nomor_rekening'],
                'nomor_telepon' => $data['nomor_telepon'],
                'idInfoSupplier'=>$data['idInfoSupplier']
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
