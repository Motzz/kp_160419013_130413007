<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ItemCategoryController extends Controller
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
        $dataCategory = DB::table('ItemCategory')
            ->get();
        $dataCOA = DB::table('COA')
            ->get();
        return view('master.itemCategory',[
            'dataCategory' => $dataCategory,
            'dataCOA' => $dataCOA,
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
        $dataCOA = DB::table('COA')
            ->get();
        return view('master.itemCategory_tambah',[
            'dataCOA' => $dataCOA,
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
        
        DB::table('ItemCategory')
            ->insert(array(
                'Name' => $data['name'],
                'Remarks' => $data['remarks'],
                'NTBDebetCOA' => $data['NTBDebetCOA'],
                'NTBKreditCOA' => $data['NTBKreditCOA'],
                'BillVDebetCOA' => $data['BillVDebetCOA'],
                'BillVKreditCOA' => $data['BillVKreditCOA'],
                'PenjualanCOA' => $data['PenjualanCOA'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        ); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategory $itemCategory)
    {
        //
        $dataCategory = DB::table('ItemCategory')
            ->get();
        $dataCOA = DB::table('COA')
            ->get();
        return view('master.itemCategory_detail',[
            'dataCategory' => $dataCategory,
            'dataCOA' => $dataCOA,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCategory $itemCategory)
    {
        //
        $dataCOA = DB::table('COA')
            ->get();
        return view('master.itemType_edit',[
            'itemCategory'=>$itemCategory,
            'dataCOA' => $dataCOA,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategory $itemCategory)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('ItemCategory')
            ->where('ItemCategoryID', $itemCategory['id'])
            ->update(array(
                'Name' => $data['name'],
                'Remarks' => $data['remarks'],
                'NTBDebetCOA' => $data['NTBDebetCOA'],
                'NTBKreditCOA' => $data['NTBKreditCOA'],
                'BillVDebetCOA' => $data['BillVDebetCOA'],
                'BillVKreditCOA' => $data['BillVKreditCOA'],
                'PenjualanCOA' => $data['PenjualanCOA'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $itemCategory)
    {
        //
        $itemCategory->delete();
    }
}
