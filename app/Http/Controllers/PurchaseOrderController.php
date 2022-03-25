<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class PurchaseOrderController extends Controller
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
        $user = Auth::user();
        
        $getPerusahaan = DB::table('MPerusahaan')
            ->join('MGudang','MPerusahaan.MPerusahaanID','=','MPerusahaan.MPerusahaanID')  
            ->where('MGudangID',$user->MGudangID)
            ->get();

        $data = DB::table('purchase_order')
            ->select('purchase_order.*')
            ->join('users', 'purchase_order.created_by', '=', 'users.id')
            ->join('MGudang','users.MGudangID','=','MGudang.MGudangID')  
            ->join('MKota','MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp','=','MPerusahaan.MPerusahaanID')
            ->where('purchase_order.hapus','=', 0)  
            ->where('MPerusahaan.MPerusahaanID', $getPerusahaan[0]->MPerusahaanID)  
            ->get();
        return view('master.PurchaseOrder.index',[
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

        $dataSupplier = DB::table('MSupplier')
            ->get();

        $dataPayment = DB::table('PaymentTerms')
            ->select('PaymentTerms.*', 'Payment.Name as PaymentName', 'Payment.Deskripsi as PaymentDeskripsi')
            ->leftjoin('Payment', 'PaymentTerms.PaymentID','=','Payment.PaymentID')
            ->get();

        $dataBarang = DB::table('Item')
            ->select('Item.*', 'Unit.Name as unitName')
            ->join('Unit','Item.UnitID', '=', 'Unit.UnitID')
            ->leftjoin('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->where('Item.Hapus',0)
            ->get();

        $dataBarangTag = DB::table('Item')
            ->select('Item.*', 'Unit.Name as unitName','ItemTagValues.ItemTagID')
            ->join('Unit','Item.UnitID', '=', 'Unit.UnitID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->where('Item.Hapus',0)
            ->get();
        //dd($dataBarangTag);
        $dataTag = DB::table('ItemTag')
            ->get();
        $dataTax=DB::table('Tax')
            ->get();

        
        //data Purchase Request yang disetujui
        $dataPurchaseRequestDetail = DB::table('purchase_request_detail')
            ->select('purchase_request_detail.*','purchase_request.name')//
            ->join('purchase_request', 'purchase_request_detail.idPurchaseRequest', '=','purchase_request.id')
            ->where('purchase_request.approved', 1)
            ->where('purchase_request.approvedAkhir', 1)
            ->where('purchase_request.hapus', 0)
            ->where('purchase_request.proses', 1)
            ->where('purchase_request_detail.jumlahProses', '<', DB::raw('purchase_request_detail.jumlah'))//errorr disini
            ->get();
//dd($dataPurchaseRequestDetail);
        //nama npp create
        $dataLokasi = DB::table('MGudang')
            ->select('MKota.*','MPerusahaan.cnames as perusahaanCode')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.MPerusahaanID')
            ->where('MGudang.MGudangID', '=', $user->MGudangID)
            ->get();
        $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        $dataOrder = DB::table('purchase_order')
            ->where('name', 'like', 'PO/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/%")
            ->get();   
        $totalIndex = str_pad(strval(count($dataOrder) + 1),4,'0',STR_PAD_LEFT);
        $namaPo = 'PO/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/".$totalIndex;
        

        return view('master.PurchaseOrder.tambah',[
            'dataSupplier' => $dataSupplier,
            'dataPayment' => $dataPayment,
            'dataBarangTag' => $dataBarangTag,
            'dataBarang' => $dataBarang,
            'namaPo' => $namaPo,
            'date' => $date,
            'dataTag' => $dataTag,
            'dataTax' => $dataTax,
            'dataPurchaseRequestDetail' => $dataPurchaseRequestDetail,
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
        $year = date("Y");
        $month = date("m");

        $dataLokasi = DB::table('MGudang')
            ->select('MKota.*','MPerusahaan.cnames as perusahaanCode')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.MPerusahaanID')
            ->where('MGudang.MGudangID', '=', $user->MGudangID)
            ->get();
        
        $dataPo = DB::table('purchase_order')
            ->where('name', 'like', 'PO/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/%")
            ->get();
        

        $totalIndex = str_pad(strval(count($dataPo) + 1),4,'0',STR_PAD_LEFT);

        $idpo = DB::table('purchase_order')->insertGetId(array(
            'name' => 'PO/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/".$totalIndex,
            'idSupplier' => $data['supplier'],
            'idPaymentTerms' => $data['paymentTerms'],
            'tanggal_akhir' => $data['tanggal_akhir'],
            'approved' => 0,
            'hapus' => 0,
            'proses' => 0,         
            'created_by'=> $user->id,
            'created_on'=> date("Y-m-d h:i:sa"),
            'updated_by'=> $user->id,
            'updated_on'=> date("Y-m-d h:i:sa"),
            )
        ); 

        $totalHarga = 0;

        for($i = 0; $i < count($data['itemId']); $i++){
            DB::table('purchase_order_detail')->insert(array(
                'idPurchaseOrder' => $idpo,
                'idPurchaseRequestDetail' => $data['idPurchaseRequestDetail'][$i],
                'idItem' => $data['itemId'][$i],
                'jumlah' => $data['itemTotal'][$i],
                'harga' => $data['itemHarga'][$i],
                'idTax' => $data['tax'][$i],
                'keterangan' => $data['itemKeterangan'][$i],
                )
            ); 

            $totalNow = DB::table('purchase_request_detail')->select('jumlah')->where('id', $data['idPurchaseRequestDetail'][$i])->get();
            DB::table('purchase_request_detail')
            ->where('id', $data['idPurchaseRequestDetail'][$i])
            ->update([
                'jumlahProses' => $totalNow[0]->jumlah + $data['itemTotal'][$i],
            ]);
            
            $totalHarga += $data['itemHarga'][$i] * $data['itemTotal'][$i] * (100 - $data['taxPercent'][$i]) / 100;
            
            
        }

        DB::table('purchase_order')
            ->where('id', $idpo)
            ->update([
                'totalHarga' =>  $totalHarga,
        ]);

        return redirect()->route('PurchaseOrder.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
        $dataDetail = DB::table('purchase_order_detail')
            ->where('purchase_order_detail.idPurchaseOrder', '=', $purchaseOrder->id)
            ->get();
        return view('master.PurchaseOrder.detail',[
            'purchaseOrder' => $purchaseOrder,
            'dataDetail' => $dataDetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
        $user = Auth::user();
        
        $dataSupplier = DB::table('MSupplier')
            ->get();

        $dataPayment = DB::table('PaymentTerms')
            ->select('PaymentTerms.*', 'Payment.Name as PaymentName', 'Payment.Deskripsi as PaymentDeskripsi')
            ->leftjoin('Payment', 'PaymentTerms.PaymentID','=','Payment.PaymentID')
            ->get();

        $dataBarang = DB::table('Item')
            ->select('Item.*', 'Unit.Name as unitName')
            ->join('Unit','Item.UnitID', '=', 'Unit.UnitID')
            ->where('Item.Hapus',0)
            ->get();

        //data Purchase Request yang disetujui
        $dataPurchaseRequestDetail = DB::table('purchase_request_detail')
            ->select('purchase_request_detail.*','purchase_request.name')
            ->join('purchase_request', 'purchase_request_detail.idPurchaseRequest', '=','purchase_request.id')
            ->where('purchase_request.approved', 1)
            ->where('purchase_request.approvedAkhir', 1)
            ->where('purchase_request.hapus', 0)
            ->where('purchase_request.proses', 1)
            ->where('purchase_request_detail.jumlahProses', '<', 'purchase_request_detail.jumlah')
            ->get();

        $dataDetail = DB::table('purchase_order_detail')
            ->where('purchase_request_detail.idPurchaseRequest', '=', $purchaseOrder->id)
            ->get();
        return view('master.PurchaseOrder.edit',[
            'purchaseOrder'=>$purchaseOrder,
            'dataDetail'=>$dataDetail,
            'dataSupplier' => $dataSupplier,
            'dataPayment' => $dataPayment,
            'dataBarang' => $dataBarang,
            'dataPurchaseRequestDetail' => $dataPurchaseRequestDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        $year = date("Y");
        $month = date("m");

        DB::table('purchase_order')
            ->where('id', $purchaseOrder->id)
            ->update([
                'idSupplier' => $data['supplier'],
                'idPaymentTerms' => $data['paymentTerms'],
                'tanggal_akhir' => $data['tanggal_akhir'],
                'updated_by'=> $user->id,
                'updated_on'=> date("Y-m-d h:i:sa"),
        ]);

        $dataDetailTotal = DB::table('purchase_order_detail')
            ->where('idPurchaseOrder', $purchaseOrder->id)
            ->get();

        $totalHarga = 0;

        if(count($dataDetailTotal) > count($data['itemId'])){
            DB::table('purchase_order_detail')
                ->where('idPurchaseOrder', $purchaseOrder->id)
                ->delete();
            
            for($i = 0; $i < count($data['itemId']); $i++){
                DB::table('purchase_order_detail')->insert(array(
                    'idPurchaseOrder' => $purchaseOrder->id,
                    'idPurchaseRequestDetail' => $data['idPurchaseRequestDetail'],
                    'idItem' => $data['itemId'][$i],
                    'jumlah' => $data['itemTotal'][$i],
                    'harga' => $data['itemHarga'][$i],
                    'idTax' => $data['tax'][$i],
                    'keterangan' => $data['itemKeterangan'][$i],
                    )
                ); 
                $totalHarga += $data['itemHarga'][$i] * $data['itemTotal'][$i] * $data['taxPercent'][$i];
            }     
        }
        else{
            for($i = 0; $i < count($data['itemId']); $i++){
                if($i < count($dataDetailTotal)){
                    DB::table('purchase_order_detail')
                    ->where('idPurchaseOrder', $purchaseOrder->id)
                    ->update(array(
                        'idItem' => $data['itemId'][$i],
                        'jumlah' => $data['itemTotal'][$i],
                        'harga' => $data['itemHarga'][$i],
                        'idTax' => $data['tax'][$i],
                        'keterangan' => $data['itemKeterangan'][$i],
                        )           
                    );
                    $totalHarga += $data['itemHarga'][$i] * $data['itemTotal'][$i] * $data['taxPercent'][$i];
      
                }
                else{
                    DB::table('purchase_order_detail')->insert(array(
                        'idPurchaseOrder' => $purchaseOrder->id,
                        'idPurchaseRequestDetail' => $data['idPurchaseRequestDetail'],
                        'idItem' => $data['itemId'][$i],
                        'jumlah' => $data['itemTotal'][$i],
                        'harga' => $data['itemHarga'][$i],
                        'idTax' => $data['tax'][$i],
                        'keterangan' => $data['itemKeterangan'][$i],
                        )
                    ); 
                    $totalHarga += $data['itemHarga'][$i] * $data['itemTotal'][$i] * $data['taxPercent'][$i];     
                }
            }
        }
        DB::table('purchase_order')
            ->where('id', $purchaseOrder->id)
            ->update([
                'totalHarga' =>  $totalHarga,
        ]);

        return redirect()->route('PurchaseOrder.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
        DB::table('purchase_order')
            ->where('id', $purchaseOrder->id)
            ->update([
                'hapus' =>  1,
        ]);

        return redirect()->route('PurchaseOrder.index')->with('status','Success!!');
    }
}
