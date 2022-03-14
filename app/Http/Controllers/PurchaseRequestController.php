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
        $getLokasi = DB::table('MGudang')
            ->where('MGudang.MGudangID', '=', $user->MGudangID)
            ->get();
        $data = DB::table('purchase_request')
            ->select('purchase_request.*')
            ->join('users', 'purchase_request.created_by', '=', 'users.id')
            ->join('MGudang','users.MGudangID','=','MGudang.MGudangID')  
            ->join('MKota','MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp','=','MPerusahaan.MPerusahaanID')
            ->where('MKota.cidkota', '=', $getLokasi[0]->cidkota)
            ->where('MPerusahaan.MPerusahaanID','=', $getLokasi[0]->cidp)
            ->where('purchase_request.hapus','=', 0)    
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

        $getLokasi = DB::table('MGudang')
            ->where('MGudang.MGudangID', '=', $user->MGudangID)
            ->get();

        $dataGudang = DB::table('MGudang')
            ->select('MGudang.*')
            ->join('MKota','MGudang.cidkota','=','MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp','=','MPerusahaan.MPerusahaanID')
            ->where('MKota.cidkota', $getLokasi[0]->cidkota)
            ->where('MPerusahaan.MPerusahaanID','=', $getLokasi[0]->cidp)
            ->get();
    
        $dataBarang = DB::table('Item')
            ->select('Item.*', 'Unit.Name as unitName')
            ->join('Unit','Item.UnitID', '=', 'Unit.UnitID')
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

        /*$getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();
        */

        $dataLokasi = DB::table('MGudang')
            ->select('MKota.*','MPerusahaan.cnames as perusahaanCode')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.cidp')
            ->where('MGudang.id', '=', $user->MGudangID)
            ->get();
        
        $dataPermintaan = DB::table('purchase_request')
            ->where('name', 'like', 'NPP/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/%")
            ->get();
        

        $totalIndex = str_pad(strval(count($dataPermintaan) + 1),4,'0',STR_PAD_LEFT);

        $idpr = DB::table('purchase_request')->insertGetId(array(
            'name' => 'NPP/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/".$totalIndex,
            'idGudang' => $data['gudang'],
            'approved' => 0,
            'hapus' => 0,
            'created_by'=> $user->id,
            'created_on'=> date("Y-m-d h:i:sa"),
            'updated_by'=> $user->id,
            'updated_on'=> date("Y-m-d h:i:sa"),
            )
        ); 

        for($i = 0; $i < count($data['totalRequest']); $i++){
            if(isset($data['barang'][$i])){
                DB::table('purchase_request_detail')->insert(array(
                    'idPurchaseRequest' => $idpr,
                    'jumlah' => $data['jumlah'][$i],
                    'idBarang' => $data['barang'][$i],
                    'jasa' => 0,
                    'harga' => $data['harga'][$i],
                    )
               ); 
            }
            elseif(isset($data['jasa'][$i])){
                DB::table('purchase_request_detail')->insert(array(
                    'idPurchaseRequest' => $idpr,
                    'jasa' => 1,
                    'jumlah' =>1,
                    'keterangan_jasa' => $data['keterangan'][$i],
                    'harga' => $data['harga'][$i],
                    )
               ); 
            }
            
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
        $dataDetail = DB::table('purchase_request_detail')
            ->where('purchase_request_detail.idPurchaseRequest', '=', $purchaseRequest->id)
            ->get();
        return view('master.purchase_request_tambah',[
            'purchaseRequest' => $purchaseRequest,
            'dataDetail' => $dataDetail,
        ]);
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

        $dataDetail = DB::table('purchase_request_detail')
            ->where('purchase_request_detail.idPurchaseRequest', '=', $purchaseRequest->id)
            ->get();
        return view('master.purchase_request_edit',[
            'purchaseRequest'=>$purchaseRequest,
            'dataDetail'=>$dataDetail,
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
        $month = date("m");

        DB::table('purchase_request')
            ->where('id', $purchaseRequest->id)
            ->update([
                'MGudangID' => $data['MGudangID'],
                'updated_by'=> $user->id,
                'updated_on'=> date("Y-m-d h:i:sa"),
        ]);

        $dataDetailTotal = DB::table('purchase_request_detail')
            ->where('idPurchaseRequest', $purchaseRequest->id)
            ->get();

        if(count($dataDetailTotal) > count($data['totalRequest'])){
            DB::table('purchase_request_detail')
                ->where('idPurchaseRequest', $purchaseRequest->id)
                ->delete();

            for($i = 0; $i < count($data['totalRequest']); $i++){
                if(isset($data['barang'][$i])){
                    DB::table('purchase_request_detail')->insert(array(
                        'idPurchaseRequest' => $purchaseRequest->id,
                        'jumlah' => $data['jumlah'][$i],
                        'idBarang' => $data['barang'][$i],
                        'jasa' => 0,
                        'harga' => $data['harga'][$i],
                        )
                   ); 
                }
                elseif(isset($data['jasa'][$i])){
                    DB::table('purchase_request_detail')->insert(array(
                        'idPurchaseRequest' => $purchaseRequest->id,
                        'jasa' => 1,
                        'jumlah' =>1,
                        'keterangan_jasa' => $data['keterangan'][$i],
                        'harga' => $data['harga'][$i],
                        )
                    ); 
                }
            }
        }
        else{
            for($i = 0; $i < count($data['totalRequest']); $i++){
                if($i < count($dataDetailTotal)){
                    if(isset($data['barang'][$i])){
                        DB::table('purchase_request_detail')
                        ->where('idPurchaseRequest', $purchaseRequest->id)
                        ->update(array(
                            'jumlah' => $data['jumlah'][$i],
                            'idBarang' => $data['barang'][$i],
                            'jasa' => 0,
                            'keterangan_jasa' => '',
                            'harga' => $data['harga'][$i],
                        )
                    );
                    }
                    elseif(isset($data['jasa'][$i])){
                        DB::table('purchase_request_detail')
                        ->where('idPurchaseRequest', $purchaseRequest->id)
                        ->update(array(
                            'jumlah' => 1,
                            'idBarang' => null,
                            'jasa' => 1,
                            'keterangan_jasa' => $data['keterangan'][$i],
                            'harga' => $data['harga'][$i],
                            )
                        );
                    }
                    
                }
                else{
                    if(isset($data['barang'][$i])){
                        DB::table('purchase_request_detail')->insert(array(
                            'idPurchaseRequest' => $purchaseRequest->id,
                            'jumlah' => $data['jumlah'][$i],
                            'idBarang' => $data['barang'][$i],
                            'jasa' => 0,
                            'harga' => $data['harga'][$i],
                            )
                       ); 
                    }
                    elseif(isset($data['jasa'][$i])){
                        DB::table('purchase_request_detail')->insert(array(
                            'idPurchaseRequest' => $purchaseRequest->id,
                            'jasa' => 1,
                            'jumlah' =>1,
                            'keterangan_jasa' => $data['keterangan'][$i],
                            'harga' => $data['harga'][$i],
                            )
                        ); 
                    }
                }
            }
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
        DB::table('purchase_request')
            ->where('id', $purchaseRequest->id)
            ->update([
                'hapus' => 1,
        ]);
       return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }
}
