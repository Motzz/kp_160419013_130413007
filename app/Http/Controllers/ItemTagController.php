<?php

namespace App\Http\Controllers;

use App\Models\ItemTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ItemTagController extends Controller
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
        $data = DB::table('ItemTag')
            ->get();
        return view('master.itemTag',[
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
        return view('master.itemTag_tambah');
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
        
        DB::table('ItemTag')
            ->insert(array(
                'Name' => $data['name'],
                'Desc' => $data['desc'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        ); 
        //return redirect()->route('pt.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function show(ItemTag $itemTag)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTag $itemTag)
    {
        //
        return view('master.itemTag_edit',[
            'itemTag'=>$itemTag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemTag $itemTag)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('ItemTag')
            ->where('ItemTagID', $itemTag['id'])
            ->update(array(
                'Name' => $data['name'],
                'Desc' => $data['desc'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );

        //return redirect()->route('pt.index')->with('status','Success!!');             
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemTag $itemTag)
    {
        //
        $itemTag->delete();
        //return redirect()->route('itemTag.index')->with('status','Success!!');
    }
}
