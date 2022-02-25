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
        $user = Auth::user();
        //
        $getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();
        $data = DB::table('purchase_request')
            ->select('purchase_request.*')
            ->join('users', 'purchase_request.created_by', '=', 'users.id')
            ->join('gudang','users.idGudang','=','gudang.id')
            ->join('lokasi','gudang.idLokasi', '=', 'lokasi.id')
            ->where('lokasi.id', '=', $getLokasi[0]->idLokasi)
            ->get();
        return view('master.purchase_request',[
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
        return view('master.purchase_request',[
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
        $user = Auth::user();

        $getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();

        $dataGudang = DB::table('gudang')
            ->select('gudang.*')
            ->join('lokasi','gudang.idLokasi','=','lokasi.id')
            ->where('lokasi.id', $getLokasi[0]->idLokasi)
            ->get();
    
        $dataBarang = DB::table('barang')
            ->select('barang.*', 'satuan.name as satuanName')
            ->join('satuan','barang.idSatuan', '=', 'satuan.id')
            ->get();
        return view('master.purchase_request_tambah',[
            'dataGudang' => $dataGudang,
            'dataBarang' => $dataBarang,
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
        //echo $data['barang'][0];
        //echo count($data['jumlah']);
        $user = Auth::user();
        $year = date("Y");
        $month = date("m");

        $getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();
        

        $dataLokasi = DB::table('lokasi')
            ->select('lokasi.*','pt.Alias as ptAlias')
            ->join('pt', 'lokasi.idPt', '=', 'pt.id')
            ->join('gudang', 'lokasi.id', '=', 'gudang.idLokasi')
            ->where('lokasi.id', '=', $getLokasi[0]->idLokasi)
            ->get();
        
        $dataPermintaan = DB::table('purchase_request')
            ->where('name', 'like', 'NPP/'.$dataLokasi[0]->ptAlias.'/'.$dataLokasi[0]->alias.'/'.$year.'/'.$month."/%")
            ->get();
        

        $totalIndex = str_pad(strval(count($dataPermintaan) + 1),4,'0',STR_PAD_LEFT);

        $idpr = DB::table('purchase_request')->insertGetId(array(
            'name' => 'NPP/'.$dataLokasi[0]->ptAlias.'/'.$dataLokasi[0]->alias.'/'.$year.'/'.$month."/".$totalIndex,
            'idLokasi' => $dataLokasi[0]->id,
            'idGudang' => $data['gudang'],
            'created_by'=> $user->id,
            'created_on'=> date("Y-m-d h:i:sa"),
            'updated_by'=> $user->id,
            'updated_on'=> date("Y-m-d h:i:sa"),
            )
       ); 

        for($i = 0; $i < count($data['barang']); $i++){
            DB::table('purchase_request_detail')->insert(array(
                'idPurchaseRequest' => $idpr,
                'jumlah' => $data['jumlah'][$i],
                'idBarang' => $data['barang'][$i],
                )
           ); 
        }

        return redirect()->route('purchaseRequest.index')->with('status','Success!!');
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
          $user = Auth::user();

        $getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();

        $dataGudang = DB::table('gudang')
            ->select('gudang.*')
            ->join('lokasi','gudang.idLokasi','=','lokasi.id')
            ->where('lokasi.id', $getLokasi[0]->idLokasi)
            ->get();
    
        $dataBarang = DB::table('barang')
            ->select('barang.*', 'satuan.name as satuanName')
            ->join('satuan','barang.idSatuan', '=', 'satuan.id')
            ->get();
        return view('master.purchase_request_edit',[
            'purchaseRequest'=>$purchaseRequest,
            'dataGudang' => $dataGudang,
            'dataBarang' => $dataBarang,
        ]);

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
        //belommm
        $data = $request->collect();
        $user = Auth::user();
        $year = date("Y");
        $month = date("mm");

        $dataLokasi = DB::table('lokasi')
            ->join('pt', 'lokasi.idPt', '=', 'pt.id')
            ->join('gudang', 'lokasi.id', '=', 'gudang.idLokasi')
            ->where('lokasi.id', '=', $user->idLokasi)
            ->get();
        
        $dataPermintaan = DB::table('purchase_request')
            ->where('name', '=', 'NPP/'.$dataLokasi[0]->pt_Alias.'/'.$dataLokasi[0]->alias.'/'.$year.'/'.$month."/*")
            ->get();
        

        $totalIndex = str_pad("array_count_values($dataPermintaan) + 1",4,'0',STR_PAD_LEFT);

        $idpr = DB::table('purchase_request')->insertGetId(array(
            'name' => 'NPP/'.$dataLokasi[0]->pt_Alias.'/'.$dataLokasi[0]->alias.'/'.$year.'/'.$month."/".$totalIndex,
            'idLokasi' => $dataLokasi[0]->id,
            'idGudang' => $data['??? berdasarkan combo box'],
            'updated_by'=> $user->id,
            'updated_on'=> date("Y-m-d h:i:sa"),
            )
       ); 

        for($i = 0; $i < $data['total_barang']; $i++){
            DB::table('purchase_request_detail')->insert(array(
                'idPurchaseRequest' => $idpr,
                'jumlah' => $data['jumlah'.$i],
                //'harga' => $data['???????'],
                'idBarang' => $data['barang'.$i],
                )
           ); 
        }
        return redirect()->route('purchaseRequest.index')->with('status','Success!!');
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
       // echo $purchaseRequest->id;
        //dd($purchaseRequest->id);
        DB::table('purchase_request_detail')
            ->where('idPurchaseRequest','=',$purchaseRequest->id)
            ->delete();
        $purchaseRequest->delete();
       return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }
}
