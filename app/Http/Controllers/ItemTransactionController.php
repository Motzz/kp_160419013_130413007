<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ItemTransactionController extends Controller
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
        $data = DB::table('ItemTransaction')
            ->get();
        return view('master.itemTransaction',[
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
        return view('master.itemTransaction_tambah');
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
        
        DB::table('ItemTransaction')
            ->insert(array(
                'Name' => $data['name'],
                'Description' => $data['desc'],
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
     * @param  \App\Models\ItemTransaction  $itemTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTransaction $itemTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemTransaction  $itemTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTransaction $itemTransaction)
    {
        //
        return view('master.itemTransaction_edit',[
            'itemTransaction'=>$itemTransaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemTransaction  $itemTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTransaction $itemTransaction)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('ItemTransaction')
            ->where('ItemTransactionID', $itemTransaction['id'])
            ->update(array(
                'Name' => $data['name'],
                'Description' => $data['desc'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemTransaction  $itemTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemTransaction $itemTransaction)
    {
        //
        $itemTransaction->delete();
    }
}