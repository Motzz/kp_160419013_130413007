<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ItemController extends Controller
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
        $dataItem = DB::table('Item')
            //->select('Item.*', 'ItemType.Name as typeName', 'Unit.Name as unitName', 'ItemCategory.Name as categoryName', 
            //'ItemTracing.Name as tracingName', 'ItemTag.Name as tagName')
            ->join('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->join('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->join('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->join('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->join('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->get();

        dd($dataItem);
        /*$dataSatuan = DB::table('satuan')
            ->get();
        return view('/master/barang',[
            'dataBarang' => $dataBarang,
            'dataSatuan' => $dataSatuan,
        ]);*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataType = DB::table('ItemType')
            ->get();
        $dataUnit = DB::table('Unit')
            ->get();
        $dataCategory = DB::table('ItemCategory')
            ->get();
        $dataTracing = DB::table('ItemTracing')
            ->get();
        $dataTag = DB::table('ItemTag')
            ->get();
        dd($dataItem);
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

        $idItem = DB::table('Item')->insertGetId(array(
            'ItemTypeID' => $data['typeItem'],
            'ItemName' => $data['nameItem'],
            'UnitID' => $data['itemUnit'],
            'ItemCategoryID'=> $data['itemCategory'],
            'Notes'=> $data['note'],
            'CanBeSell'=> $data['canBeSell'],
            'CanBePurchased'=> $data['canBePurchased'],
            'ItemTracingID'=> $data['itemTracing'],
            'CreatedBy'=> $user->id,
            'CreatedOn'=> date("Y-m-d h:i:sa"),
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
            'Hapus' => 0,
            'HaveExpiredDate' => $data['expiredDate'],
            )
        ); 

        for($i = 0; $i < count($data['itemTagTotal']); $i++){
            DB::table('ItemTagValues')->insert(array(
                'ItemID' => $idItem,
                'ItemTagID' => $data['itemTagID'][$i],
                )
           ); 
        }

        //return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        /*$dataItem = DB::table('Item')
            ->join('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->join('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->join('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->join('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->join('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->get();

        dd($dataItem);*/
        return view('master.barang_edit',[
            'item'=>$item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        $dataItem = DB::table('Item')
            ->join('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->join('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->join('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->join('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->join('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->get();

        dd($dataItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        $data = $request->collect();
        $user = Auth::user();

        DB::table('Item')
            ->where('id', $item->ItemID)
            ->update(array(
                'ItemTypeID' => $data['typeItem'],
                'ItemName' => $data['nameItem'],
                'UnitID' => $data['itemUnit'],
                'ItemCategoryID'=> $data['itemCategory'],
                'Notes'=> $data['note'],
                'CanBeSell'=> $data['canBeSell'],
                'CanBePurchased'=> $data['canBePurchased'],
                'ItemTracingID'=> $data['itemTracing'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
                'Hapus' => 0,
                'HaveExpiredDate' => $data['expiredDate'],
        ));

        $dataTagValues = DB::table('ItemTagValues')
            ->where('ItemID', $item->ItemID)
            ->get();

        if(count($dataTagValues) > count($data['itemTagTotal'])){
            DB::table('ItemTagValues')
                ->where('ItemID','=',$item->ItemID)
                ->delete();

            for($i = 0; $i < count($data['itemTagTotal']); $i++){
            DB::table('ItemTagValues')
                ->insert(array(
                    'ItemID' => $idItem,
                    'ItemTagID' => $data['itemTagID'][$i],
                    )
                ); 
            }
        }
        else{
            for($i = 0; $i < count($data['itemTagTotal']); $i++){
                if($i < count($dataTagValues)){
                    DB::table('ItemTagValues')
                        ->where('idItem', $item->ItemID)
                        ->update(array(
                            'ItemTagID' => $data['itemTagID'][$i],
                        )
                    );
                }
                else{
                    DB::table('ItemTagValues')
                        ->insert(array(
                            'ItemID' => $item->ItemID,
                            'ItemTagID' => $data['itemTagID'][$i],
                        )
                    ); 
                }
            }
        }
        
        return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        DB::table('ItemTagValues')
            ->where('ItemID','=',$item->ItemID)
            ->delete();
        $item->delete();
        return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }
}
