<?php

namespace App\Http\Controllers;

use App\Models\COA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class COAController extends Controller
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
        $dataCOA = DB::table('COA')
            ->get();
        $dataCOAHead = DB::table('COAHead')
            ->get();
        $dataCOADetail = DB::table('COADetail')
            ->get();
        return view('master.coa.index',[
            'dataCOA' => $dataCOA,
            'dataCOAHead' => $dataCOAHead,
            'dataCOADetail' => $dataCOADetail,
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
        $dataCOAHead = DB::table('COAHead')
            ->get();
        $dataCOADetail = DB::table('COADetail')
            ->get();

        return view('master.COA.tambah',[
            'dataCOA' => $dataCOA,
            'dataCOAHead' => $dataCOAHead,
            'dataCOADetail' => $dataCOADetail,
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
        
        DB::table('COA')
            ->insert(array(
                'Nomor' => $data['Nomor'],
                'Nama' => $data['Nama'],
                'Chead' => $data['Chead'],
                'Cdet' => $data['Cdet'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        ); 
        return redirect()->route('coa.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\COA  $COA
     * @return \Illuminate\Http\Response
     */
    public function show(COA $coa)
    {
        //
        $dataCOA = DB::table('COA')
            ->join('COADetail', 'COA.Cdet','=','COADetail.Cdet')
            ->join('COAHead', 'COA.Chead','=','COAHead.CH_ID')
            ->get();
        return view('master.coa_detail',[
            'dataCOA' => $dataCOA,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\COA  $COA
     * @return \Illuminate\Http\Response
     */
    public function edit(COA $coa)
    {
        //
        $dataCOAHead = DB::table('COAHead')
            ->get();
        $dataCOADetail = DB::table('COADetail')
            ->get();
        return view('master.coa.edit',[
            'COA'=>$coa,
            'dataCOAHead' => $dataCOAHead,
            'dataCOADetail' => $dataCOADetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\COA  $COA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, COA $coa)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('COA')
            ->where('COAID', $coa['COAID'])
            ->update(array(
                'Nomor' => $data['nomor'],
                'Nama' => $data['nama'],
                'Chead' => $data['chead'],
                'Cdet' => $data['cdet'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
          return redirect()->route('coa.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\COA  $COA
     * @return \Illuminate\Http\Response
     */
    public function destroy(COA $coa)
    {
        //
        $coa->delete();
        return redirect()->route('coa.index')->with('status','Success!!');
    }
}
