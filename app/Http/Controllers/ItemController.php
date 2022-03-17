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
        $user = Auth::user();

        $dataItem = DB::table('Item')
            //->limit(100)
            
            ->select('Item.*', 'ItemType.Name as typeName' ,'ItemType.Notes as typeNotes', 'Unit.Name as unitName', 
            'ItemCategory.Name as categoryName', 'ItemTracing.Name as tracingName')
            //, 'ItemTag.ItemTagID as tagID', 'ItemTag.Name as tagName')
            
            ->leftjoin('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->leftjoin('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->leftjoin('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->leftjoin('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            //->leftjoin('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            //->leftjoin('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->where('Item.Hapus', '=', 0)
            ->simplePaginate(10);
        //dd($dataItem);
        $dataTag = DB::table('ItemTag')
            ->leftjoin('ItemTagValues', 'ItemTag.ItemTagID', '=', 'ItemTagValues.ItemTagID')
            ->get();


        /*$access = DB::table('menu')
            ->select('menu.url')
            ->leftjoin('role_access', 'menu.MenuID', '=', 'role_access.idMenu')
            ->leftjoin('user_access', 'menu.MenuID', '=', 'user_access.idMenu')
            ->where('role_access.idRole',$user->idRole)
            ->orWhere('user_access.idUsers',$user->id)
            ->get();
        */
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        
        if($check){
            return view('master.item.index',[
                'dataItem' => $dataItem,
                'dataTag' => $dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
        
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
        $user = Auth::user();
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

        
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        if($check){
            return view('master.item.tambah',[
                'dataType'=>$dataType,
                'dataUnit'=>$dataUnit,
                'dataCategory'=>$dataCategory,
                'dataTracing'=>$dataTracing,
                'dataTag'=>$dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

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
            'CreatedBy'=> $user->id,//
            'CreatedOn'=> date("Y-m-d h:i:sa"),//
            'UpdatedBy'=> $user->id,//
            'UpdatedOn'=> date("Y-m-d h:i:sa"),//
            'Hapus' => 0,//
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

        return redirect()->route('item.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $user = Auth::user();

        //
        /*$dataItem = DB::table('Item')
            ->select('Item.*', 'ItemType.Name as typeName', 'ItemType.Notes as typeNotes', 'Unit.Name as unitName', 
            'ItemCategory.Name as categoryName', 'ItemTracing.Name as tracingName', 'ItemTag.Name as tagName')
            ->limit(100)
            ->leftjoin('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->leftjoin('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->leftjoin('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->leftjoin('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->leftjoin('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->leftjoin('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->get();

        dd($dataItem);*/
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        if($check){
            return view('master.barang_edit',[
                'item'=>$item,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $user = Auth::user();

        //
        /*$dataItem = DB::table('Item')
            ->join('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->join('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->join('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->join('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->join('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->get();

        dd($dataItem);
        */
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
        
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        if($check){
            return view('master.item.edit',[
                'item'=>$item,
                'dataType'=>$dataType,
                'dataUnit'=>$dataUnit,
                'dataCategory'=>$dataCategory,
                'dataTracing'=>$dataTracing,
                'dataTag'=>$dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
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
                    'ItemID' => $item->ItemID,
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
        
        return redirect()->route('item.index')->with('status','Success!!');
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
        $user = Auth::user();
        DB::table('Item')
            ->where('ItemID', $item->ItemID)
            ->update(array(
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
                'Hapus' => 1,
        ));
        DB::table('ItemTagValues')
            ->where('ItemID','=',$item->ItemID)
            ->delete();


        return redirect()->route('item.index')->with('status','Success!!');
    }

    public function searchItemName(Request $request)
    {
        //
        dd($request->itemName);
        $user = Auth::user();
        $dataItem = DB::table('Item')
        
            //->limit(100)
            
            ->select('Item.*', 'ItemType.Name as typeName' ,'ItemType.Notes as typeNotes', 'Unit.Name as unitName', 
            'ItemCategory.Name as categoryName', 'ItemTracing.Name as tracingName')
            //, 'ItemTag.ItemTagID as tagID', 'ItemTag.Name as tagName')
            
            ->leftjoin('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->leftjoin('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->leftjoin('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->leftjoin('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            //->leftjoin('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            //->leftjoin('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->where('Item.Hapus', '=', 0)
            ->where('Item.ItemName','like','%'.$name.'%')
            ->simplePaginate(10);
        
        $dataTag = DB::table('ItemTag')
            ->leftjoin('ItemTagValues', 'ItemTag.ItemTagID', '=', 'ItemTagValues.ItemTagID')
            ->get();


        /*$access = DB::table('menu')
            ->select('menu.url')
            ->leftjoin('role_access', 'menu.MenuID', '=', 'role_access.idMenu')
            ->leftjoin('user_access', 'menu.MenuID', '=', 'user_access.idMenu')
            ->where('role_access.idRole',$user->idRole)
            ->orWhere('user_access.idUsers',$user->id)
            ->get();
        */
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        
        if($check){
            return view('master.item.index',[
                'dataItem' => $dataItem,
                'dataTag' => $dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
    }

    public function searchItemId($itemId)
    {
        //
        $user = Auth::user();
        $dataItem = DB::table('Item')
            //->limit(100)
            
            ->select('Item.*', 'ItemType.Name as typeName' ,'ItemType.Notes as typeNotes', 'Unit.Name as unitName', 
            'ItemCategory.Name as categoryName', 'ItemTracing.Name as tracingName')
            //, 'ItemTag.ItemTagID as tagID', 'ItemTag.Name as tagName')
            
            ->leftjoin('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->leftjoin('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->leftjoin('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->leftjoin('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            //->leftjoin('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            //->leftjoin('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->where('Item.Hapus', '=', 0)
            ->where('Item.ItemID','like','%'.$itemId.'%')
            ->simplePaginate(10);
        
        $dataTag = DB::table('ItemTag')
            ->leftjoin('ItemTagValues', 'ItemTag.ItemTagID', '=', 'ItemTagValues.ItemTagID')
            ->get();


        /*$access = DB::table('menu')
            ->select('menu.url')
            ->leftjoin('role_access', 'menu.MenuID', '=', 'role_access.idMenu')
            ->leftjoin('user_access', 'menu.MenuID', '=', 'user_access.idMenu')
            ->where('role_access.idRole',$user->idRole)
            ->orWhere('user_access.idUsers',$user->id)
            ->get();
        */
        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        
        if($check){
            return view('master.item.index',[
                'dataItem' => $dataItem,
                'dataTag' => $dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
    }

    public function searchItemTagName($itemTagName)
    {
        //
        $user = Auth::user();
        $dataItem = DB::table('Item')
            //->limit(100)
            
            ->select('Item.*', 'ItemType.Name as typeName' ,'ItemType.Notes as typeNotes', 'Unit.Name as unitName', 
            'ItemCategory.Name as categoryName', 'ItemTracing.Name as tracingName')
            ->leftjoin('ItemType', 'Item.ItemTypeID', '=', 'ItemType.ItemTypeID')
            ->leftjoin('Unit', 'Item.UnitID', '=', 'Unit.UnitID') 
            ->leftjoin('ItemCategory', 'Item.ItemCategoryID', '=', 'ItemCategory.ItemCategoryID')  
            ->leftjoin('ItemTracing', 'Item.ItemTracingID', '=', 'ItemTracing.ItemTracingID')
            ->join('ItemTagValues', 'Item.ItemID', '=', 'ItemTagValues.ItemID')
            ->leftjoin('ItemTag', 'ItemTagValues.ItemTagID', '=', 'ItemTag.ItemTagID')
            ->where('Item.Hapus', '=', 0)
            ->where('ItemTag.Name','like','%'.$itemTagName.'%')
            ->get()
            ->simplePaginate(10);

        $dataTag = DB::table('ItemTag')
            ->leftjoin('ItemTagValues', 'ItemTag.ItemTagID', '=', 'ItemTagValues.ItemTagID')
            ->get(); 


        $check = $this->checkAccess('item.index', $user->id, $user->idRole);
        if($check){
            return view('master.item.index',[
                'dataItem' => $dataItem,
                'dataTag' => $dataTag,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Item Master');
        }
    }
}
