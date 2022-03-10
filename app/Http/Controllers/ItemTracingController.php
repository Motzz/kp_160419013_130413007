<?php

namespace App\Http\Controllers;

use App\Models\ItemTracing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ItemTracingController extends Controller
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
        $data = DB::table('ItemTracing')
            ->get();
        return view('master.itemTracing',[
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
        return view('master.itemTracing_tambah');
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
        
        DB::table('ItemTracing')
            ->insert(array(
                'Name' => $data['name'],
                'Notes' => $data['notes'],
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
     * @param  \App\Models\ItemTracing  $itemTracing
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTracing $itemTracing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemTracing  $itemTracing
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTracing $itemTracing)
    {
        //
        return view('master.itemTracing_edit',[
            'itemTracing'=>$itemTracing
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemTracing  $itemTracing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTracing $itemTracing)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('ItemTracing')
            ->where('ItemTracingID', $itemTracing['id'])
            ->update(array(
                'Name' => $data['name'],
                'Notes' => $data['notes'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemTracing  $itemTracing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemTracing $itemTracing)
    {
        //
        $itemTracing->delete();
    }


    public function searchItemTracingName($tracingName)
    {
        //
        $data = DB::table('ItemTracing')
            ->where('Name','like','%'.$tracingName.'%')
            ->get();
        return view('master.itemTracing',[
            'data' => $data,
        ]);
    }
}
