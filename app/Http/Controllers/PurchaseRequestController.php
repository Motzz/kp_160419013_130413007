<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PurchaseRequestController extends Controller
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
        $data = DB::table('purchase_request')
            ->join('users', 'purchase_request.created_by', '=', 'users.id')
            ->where('purchase_request.idLokasi', '=', 'users.idLokasi')
            ->get();
        return view('master.supplier',[
            'data' => $data,
        ]);

    }

    public function detailPR(Request $request)
    {
        //multi variabel (?)
        $dataIn = $request->collect();
        $data = DB::table('purchase_request')
            ->join('purchase_request_detail', 'purchase_request.id', '=', 'purchase_request_detail.idPurchaseRequest')
            ->where('purchase_request.id', '=', $data['id'])
            ->get();
        return view('master.supplier',[
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
        return view('master.purchase_request_tambah');
        
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
        $year = date("Y");
        $month = date("mm");

        $dataLokasi = DB::table('lokasi')
            ->join('pt', 'lokasi.idPt', '=', 'pt.id')
            ->where('lokasi.id', '=', $user->idLokasi)
            ->get();
        
        

        DB::table('purchase_request')->insert(array(
            'name' => 'NPP/'.$dataLokasi[0]->pt_Alias.'/'.$dataLokasi[0]->alias.'/'.$year.'/'.$month."/",
            'alamat' => $data['alamat'],
            'email' => $data['email'],
            'bank' => $data['bank'],
            'nomor_rekening' => $data['nomor_rekening'],
            'nomor_telepon' => $data['nomor_telepon'],
            )
       ); 

        for($i = 0; $i < $data['totalbarang']; $i++){
            DB::table('suppliers')->insert(array(
                'name' => $data['name'],
                'alamat' => $data['alamat'],
                'email' => $data['email'],
                'bank' => $data['bank'],
                'nomor_rekening' => $data['nomor_rekening'],
                'nomor_telepon' => $data['nomor_telepon'],
                )
           ); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }
}
